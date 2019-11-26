@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
    <div id="form">
        <div class="card bg-light-gray row-consultas mt-3 ">
            <div class=" row p-md-3 p-lg-3 ml-md-3 mr-md-3 p-3 ">
                {{--            <div class="col-md-6 col-lg-6 col-12 mb-2">--}}
                {{--                <v-select   v-model="carrera"--}}
                {{--                            class="style-chooser"--}}
                {{--                            @input="getMaterias"--}}
                {{--                            :options="carreras"--}}
                {{--                            :reduce="car => car.id"--}}
                {{--                            label="descripcion"--}}
                {{--                            placeholder="Seleccione Carrera">--}}
                {{--                    <div slot="no-options">No hay opciones aquí</div>--}}
                {{--                </v-select>--}}
                {{--            </div>--}}
                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                    <v-select v-model="materia"
                              class="style-chooser"
                              :options="materias"
                              :reduce="mat => mat.id"
                              label="descripcion"
                              placeholder="Seleccione Materia">
                              <div slot="no-options">No hay opciones aquí</div>
                    </v-select>
                </div>
                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                  <v-select v-model="profesor"
                            class="style-chooser"
                            :options="profesores"
                            :reduce="pro => pro.id"
                            label="apellido"
                            placeholder="Seleccione Profesor">
                            <div slot="no-options">No hay opciones aquí</div>
        </v-select>
                </div>
                <div class="col-12">
                    <div class="alert alert-warning text-center" v-if="datosVacios">
                        Debe seleccionar materia y/o profesor
                    </div>
                </div>
                <div class="offset-md-3 offset-lg-3 col-md-6 col-lg-6 col-12 mb-2">
                    <button v-on:click="buscar()" class="btn btn-block btn-secondary">Buscar Consultas</button>
                </div>
            </div>
            <div class="row bg-light-gray p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-2 pt-1 row-consultas"
                 v-if="sinConsultas">
                <div class="col-md-12 col-lg-12 col-12 mb-2">
                    <h3>No hay consultas disponibles</h3>
                </div>
            </div>
        </div>
        <div class="card bg-light-gray row-consultas">
            <div class="row  p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-2 pt-1 "
                 v-if="mostrarCalendario && !sinConsultas">
                <div class="col-md-4 col-lg-4 col-12 mb-2">
                    <datepicker :inline="true"
                                v-on:selected="selectFecha"
                                format="dd/mm/2019"
                                :disabled-dates="disabledDates"
                                v-model="fecha"
                                :highlighted="consultasFechas"
                                :language="es"
                    ></datepicker>
                </div>
                <div class="col-md-4 col-lg-4 col-12 mb-2">
                    <ul class="list-group">
                        <li class="list-group-item list-horario p-3 text-center"
                            v-for="(horario, index) in horarios"
                            v-on:click="selectHorario(horario.id)">
                            @{{ horario.hora }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 col-12 mb-2">
                    <div class="alert alert-success" v-if="horarioSeleccionado">
                        <span><b>Materia:</b> @{{ this.consultaSeleccionada.materia }}</span><br>
                        <span><b>Profesor:</b> @{{ this.consultaSeleccionada.profesor_apellido }},
                         @{{  this.consultaSeleccionada.profesor_nombre}}
                    </span><br>
                        <span><b>Fecha:</b> @{{ this.fechaFormateada }}</span><br>
                        <span><b>Hora:</b> @{{ this.consultaSeleccionada.hora }}</span><br>

                    </div>
                </div>
                <div class="offset-md-3 offset-lg-3 col-md-6 col-lg-6 col-12 mb-2">
                    <button v-on:click="inscripcionConfirmar()" class="btn btn-block btn-primary">Inscribirse</button>
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
          carrera: '',
          carreras: [],
          materias: @json($materias),
          materia: '',
          profesores: @json($profesores),
          profesor: '',
          diasSinClase: @json($dias_sin_clase),
          diasSinClaseFormateados: [],
          consultas: [],
          consultasAlternativas: [],
          fecha: null,
          fechaFormateada: '',
          horarios: [],
          url: '{{url('alumno/materias')}}',
          urlBuscar: '{{ url('alumno/buscar-consultas') }}',
          urlInscripcion: '{{ url('alumno/turnos-alumnos') }}',
          sinConsultas: false,
          horarioSeleccionado: null,
          consultaSeleccionada: null,
          consultaAltertiva: false,
          datosVacios: false,
          response: {},
          consultasFechas: [],
          es: vdp_translation_es.js,
          mostrarCalendario: false
        },

        methods: {
          selectFecha(val) {
            this.consultaAltertiva = false;
            this.fecha = val
            if (this.fecha) {
              this.fechaFormateada = this.fecha.getDate() + '/' + (this.fecha.getMonth() + 1) + '/' + this.fecha.getFullYear();
              this.horarios = this.consultas.filter((c) => {
                return c.numero_dia == this.fecha.getDay()
              });
              // si es undefined es porque es una alternativa
              if (this.horarios.length <= 0) {
                this.horarios = this.consultasAlternativas.filter((c) => {
                  var a = new Date(c.fecha);
                  return (a.getDate() == this.fecha.getDate() && a.getFullYear() == this.fecha.getFullYear()  && a.getMonth() == this.fecha.getMonth())
                });
                this.consultaAltertiva = true;
              }
            }
          },
          selectHorario(consultaID) {
            this.horarioSeleccionado = true;
            var c = null;
            if (!this.consultaAltertiva) {
              c = this.consultas.find((c) => {
                return c.id === consultaID
              });
            } else {
              c = this.consultasAlternativas.find((c) => {
                return c.id === consultaID
              });
            }
            this.consultaSeleccionada = c;
          },
          clearForm() {
            this.fecha = null;
            this.consultas = [];
            this.horarioSeleccionado = false;
            this.horarios = [];
          },
          inscripcionConfirmar() {
            Swal.fire({
              title: 'Confirmar inscripcion!',
              text: 'Usted se va a inscribir a la consulta, confirmar?',
              icon: 'question',
              confirmButtonText: 'Sí',
              cancelButtonText: 'No',
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                this.incripcion();
              }
            })
          },
          incripcion() {
            this.consultaExitosa = false;
            this.errorInscripcion = false;
            const data = {
              consulta_id: this.consultaSeleccionada.id,
              fecha: this.fechaFormateada,
              hora: this.consultaSeleccionada.hora,
              consulta_alternativa: this.consultaAltertiva
            };
            axios
              .post(`${this.urlInscripcion}`, data)
              .then(response => {
                  this.response = response.data;
                  if (response.data.error) {
                    toastr.error(this.response.msg, 'Error al tratar de inscribir', {timeOut: 5000})
                  } else {
                    toastr.success(this.response.msg, ' Inscripción exitosa', {timeOut: 5000})
                    this.mostrarCalendario = false;
                    this.clearForm();
                    this.profesor = ''
                    this.materia = ''
                  }
                },
                (error) => {

                })
          },
          buscar() {
            this.clearForm();
            if (this.profesor === '' && (this.materia === '' || this.materia === null)) {
              this.datosVacios = true;
              setTimeout(() => {
                this.datosVacios = false;
              }, 2000);
              return false;
            }
            this.mostrarCalendario = true;
            const data = {
              profesor: this.profesor,
              materia: this.materia
            };
            axios
              .post(`${this.urlBuscar}`, data)
              .then(response => {
                this.sinConsultas = response.data.length <= 0;
                this.consultas = response.data.consultas
                this.consultasFechas = {
                  days: this.consultas.map((c) => {
                    return c.numero_dia
                  })
                }
                this.consultasAlternativas = response.data.alternativas
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
                days: [6, 0], // Disable Saturday's and Sunday's
                dates: self.diasSinClaseFormateados// Disable an array of dates
                  ,
                customPredictor: function (date) {
                  // disables the date if it is a multiple of 5
                  if (typeof (self.consultas) != "undefined" && self.consultas.length > 0) {
                    const d = self.consultas.find((c) => {
                      return c.numero_dia == date.getDay()
                    });
                    var dateAlt = undefined;
                    if (typeof (self.consultasAlternativas) != "undefined" && self.consultasAlternativas.length > 0) {
                      dateAlt = self.consultasAlternativas.find((c) => {
                        var a = new Date(c.fecha);
                        return (a.getDate() == date.getDate() && a.getFullYear() == date.getFullYear()  && a.getMonth() == date.getMonth())
                      });
                      if (typeof (dateAlt) !== "undefined") {
                        self.consultasFechas.days.push(date.getDay())
                      }
                    }
                    if (typeof (d) === "undefined" && typeof (dateAlt) === "undefined") {
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
