@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
    <div id="form">
        <div class="card bg-light-gray row-consultas mt-lg-3 mt-md-3">
            <div class=" row p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-3 pt-3 ">
                <div class="col-md-8 col-lg-8 col-12 col-sm-12 mb-2">
                    <v-select v-model="consulta"
                              class="style-chooser"
                              :options="consultas"
                              :reduce="mat => mat.id"
                              @input="consultaSelect"
                              label="descripcion"
                              placeholder="Seleccione Consulta">
                        <div slot="no-options">No hay opciones aquí</div>
                    </v-select>
                </div>
            </div>
            <div class="row  p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-2 pt-1 "
                 v-if="mostrarCalendario">
                <div class="col-md-4 col-lg-4 col-12 mb-2">
                    <datepicker :inline="true"
                                v-on:selected="selectFecha"
                                format="dd/mm/2019"
                                :disabled-dates="disabledDates"
                                v-model="fecha"
                                :highlighted="consultasFechasH"
                                :language="es"
                    ></datepicker>
                </div>
                <div class="col-md-6 col-lg-6 col-12 mb-2">
                    <label for="motivo"><b>Motivo de la cancelación:</b></label> <br>
                    <textarea name="motivo" id="motivo" cols="50" rows="9" v-model="motivo"></textarea>
                </div>

                <hr>
                <div class="col-12">
                    <div class="alert alert-info">
                    <div class="row">
                        <div class="col-12">
                            <h4>Consulta Alternativa</h4>
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 mb-2">
                            <label for="motivo"><b>Fecha:</b></label> <br>
                            <input type="date" name="fecha" id="fecha"
                                   class="form-control input-sm"
                                   placeholder="Fecha Alternativa"
                                   v-model="fechaNueva">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 mb-2">
                            <label for="motivo"><b>Hora:</b></label> <br>
                            <input type="time" name="hora" id="hora"
                                   class="form-control input-sm"
                                   value=""
                                   v-model="horaNueva">
                        </div>
                    </div>
                    </div>
                </div>

                <div class=" col-md-12 col-lg-12 col-12 mb-2 mt-2">
                    <button v-on:click="cancelacionConfirmar()"
                            class="btn btn-block btn-primary">Cancelar Consulta</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
@section("beforeEndBody")

    <!-- Our View App goes at the end of the document -->
    <script>
      new Vue({
        el: "#form",
        components: {
          'datepicker': vuejsDatepicker,
          'v-select': VueSelect.VueSelect
        },
        data: {
          consultas: @json($consultas),
          consulta: null,
          consultasFechas: [],
          consultasFechasH: [],
          motivo: '',
          fecha: null,
          url: '{{url('alumno/materias')}}',
          es: vdp_translation_es.js,
          mostrarCalendario: false,
          fechaNueva: null,
          horaNueva: null
        },
        methods: {
          consultaSelect() {
            this.mostrarCalendario = true;
            this.consultasFechas = [];
            this.consultasFechasH = [];
            const c = this.consultas.find((c) => c.id === this.consulta);
            this.consultasFechas.push(c);
            this.consultasFechasH = {
              days: this.consultasFechas.map((c) => {
                return c.numero_dia
              })
            }
          },
          selectFecha(val) {
            this.fecha = val
            if (this.fecha) {
              this.fechaFormateada = this.fecha.getDate() + '/' + (this.fecha.getMonth() + 1) + '/' + this.fecha.getFullYear();
              this.horarios = this.consultas.filter((c) => {
                return c.numero_dia == this.fecha.getDay()
              });
            }
          },
          clearForm() {
            this.consulta = null;
            this.mostrarCalendario = false;
          },
          cancelacionConfirmar() {
            Swal.fire({
              title: 'Cancelar Consulta!',
              text: 'Usted desea cancelar la consulta, confirmar?',
              icon: 'question',
              confirmButtonText: 'Sí',
              cancelButtonText: 'No',
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                this.cancelar();
              }
            })
          },
          cancelar() {
            this.consultaExitosa = false;
            this.errorInscripcion = false;
            Swal.showLoading()
            const data = {
              consulta_id: this.consultaSeleccionada.id,
              fecha: this.fechaFormateada,
              hora: this.consultaSeleccionada.hora
            };
            axios
              .post(`${this.urlInscripcion}`, data)
              .then(response => {
                  this.response = response.data;
                  if (response.data.error) {
                    toastr.error(this.response.msg, 'Error al tratar de inscribir', {timeOut: 5000})
                  } else {
                    toastr.success(this.response.msg, ' Inscripción exitosa', {timeOut: 5000})
                    this.datosVacios = true;
                    this.clearForm();
                  }
                  Swal.hideLoading();
                },
                (error) => {
                  Swal.hideLoading();

                })
          },
        },
        computed: {
          disabledDates: {
            get() {
              var self = this;
              return {
                to: new Date(), // Disable all dates up to specific date
                // from: new Date(2016, 0, 26), // Disable all dates after specific date
                days: [0], // Disable Saturday's and Sunday's
                // todo poner dias sin clases
                // dates: [ // Disable an array of dates
                //   new Date(2019, 10, 1),
                //   new Date(2019, 10, 5),
                //   new Date(2019, 10, 18)
                // ],
                customPredictor: function (date) {
                  // disables the date if it is a multiple of 5
                  if (typeof (self.consultasFechas) != "undefined" && self.consultasFechas.length > 0) {
                    const d = self.consultasFechas.find((c) => {
                      return c.numero_dia == date.getDay()
                    });
                    if (typeof (d) === "undefined") {
                      return true
                    }
                  }
                }
              }
            }
          }
        }
      })
    </script>
    <style>
        .style-chooser .vs__search::placeholder,
        .style-chooser .vs__dropdown-toggle,
        .style-chooser .vs__dropdown-menu {
            background: white;
            border: none;
            color: black;
        }
        .style-chooser .vs__clear,
        .style-chooser .vs__open-indicator {
            fill: grey;
        }
    </style>

@endsection
