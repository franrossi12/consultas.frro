@extends("layout.layout")

@section('sidebar')
    @include("layout.profesor.sidebar")
@endsection

@section("content")
    <form id="form" v-on:submit.prevent="cancelacionConfirmar()">
        <div class="card bg-light-gray row-consultas mt-3">
            <div class="row p-3 ml-3 mr-3 mt-3">
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
            <div class="row p-3 ml-3 mr-3 mt-2 pt-1 "
                 v-if="mostrarCalendario">
                <div class="col-md-4 col-lg-4 col-12 mb-2">
                    <datepicker :inline="true"
                                v-on:selected="selectFecha"
                                format="dd/mm/2019"
                                :disabled-dates="disabledDates"
                                v-model="fecha"
                                :highlighted="consultasFechasH"
                                :language="es"
                                required
                    ></datepicker>
                </div>
                <div class="col-md-6 col-lg-6 col-12 mb-2">
                    <label for="motivo"><b>Motivo de la cancelación:</b></label> <br>
                    <textarea name="motivo" id="motivo" cols="50" rows="9" v-model="motivo"required> </textarea>
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
                                   required
                                   min="{{ date('Y-m-d') }}"
                                   v-model="fechaNueva">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 mb-2">
                            <label for="motivo"><b>Hora:</b></label> <br>
                            <input type="time" name="hora" id="hora"
                                   class="form-control input-sm"
                                   value=""
                                   required
                                   v-model="horaNueva">
                        </div>
                    </div>
                    </div>
                </div>

                <div class=" col-md-12 col-lg-12 col-12 mb-2 mt-2">
                    <button v-on:click=""
                            class="btn btn-block btn-primary"
                    TYPE="submit">Cancelar Consulta</button>
                </div>
            </div>
        </div>

    </form>
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
          diasSinClase: @json($dias_sin_clase),
          diasSinClaseFormateados: [],
          consulta: null,
          consultasFechas: [],
          consultasFechasH: [],
          motivo: '',
          fecha: null,
          url: '{{url('alumno/materias')}}',
          urlCancelar: '{{url('profesor/consultas/cancelar-futuras')}}',
          es: vdp_translation_es.js,
          mostrarCalendario: false,
          fechaNueva: null,
          horaNueva: null
        },
        methods: {
          validarForm() {
            if (this.consulta == null) {
              return false;
            }
            if (this.motivo == '') {
              return false;
            }
            if (this.fechaNueva == null) {
              return false;
            }
            if (this.horaNueva == '' || this.horaNueva == null) {
              return false;
            }
            return true;
          },
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
            debugger
            this.consulta = null;
            this.mostrarCalendario = false;
          },
          cancelacionConfirmar() {
            if (!this.validarForm()) {
              return false
            }
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
          cancelar(e) {
            Swal.showLoading()

            const fechaFor = this.fechaNueva.split('-')
            const data = {
              consulta_id: this.consulta,
              fecha: this.fechaFormateada,
              hora_nueva: this.horaNueva,
              fecha_nueva: fechaFor[2] + '/' + fechaFor[1] + '/' + fechaFor[0],
              motivo: this.motivo
            };
            axios
              .post(`${this.urlCancelar}`, data)
              .then(response => {
                  this.response = response.data;
                  if (response.data.error) {
                    toastr.error(this.response.msg, 'Error al tratar de cancelar', {timeOut: 8000})
                  } else {
                    toastr.success(this.response.msg, ' Cancelación exitosa', {timeOut: 8000})
                    this.clearForm();
                  }
                  Swal.hideLoading();
                },
                (error) => {
                  Swal.hideLoading();

                })
          },
          formatearDiasSinClase() {
            this.diasSinClaseFormateados = [];
            const self = this
            $.each(this.diasSinClase, function(key, value){
              if (value.fecha_desde === value.fecha_hasta || value.fecha_hasta === null) {
                self.diasSinClaseFormateados.push(new Date(value.fecha_desde))
              } else {
                var date1 = new Date(value.fecha_desde);
                var date2 = new Date(value.fecha_hasta);
                var diffTime = Math.abs(date2 - date1);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                for (var i = 0; i <= diffDays; i++) {
                  var auxDate = new Date(value.fecha_desde);
                  auxDate.setDate(auxDate.getDate() + i)
                  self.diasSinClaseFormateados.push(auxDate);
                }
              }
            });
          },
        },
        mounted() {
          this.formatearDiasSinClase();
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
                dates: self.diasSinClaseFormateados,// Disable an array of dates

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
        textarea {
            width: 100%;
        }
        .vdp-datepicker__calendar {
            width: 100% !important;
        }
    </style>

@endsection
