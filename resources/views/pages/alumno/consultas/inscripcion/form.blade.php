@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
    <div id="form">

        <div class="row bg-light-gray p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-3 pt-3 row-consultas">
            <div class="col-md-6 col-lg-6 col-12 mb-2">
                <v-select   v-model="carrera"
                            class="style-chooser"
                            @input="getMaterias"
                            :options="carreras"
                            :reduce="car => car.id"
                            label="descripcion"
                            placeholder="Seleccione Carrera">
                    <div slot="no-options">No hay opciones aquí</div>
                </v-select>
            </div>
            <div class="col-md-6 col-lg-6 col-12 mb-2">
                <v-select   v-model="materia"
                            class="style-chooser"
                            :options="materias"
                            :reduce="mat => mat.id"
                            label="descripcion"
                            placeholder="Seleccione Materia">
                    <div slot="no-options">No hay opciones aquí</div>
                </v-select>
            </div>
            <div class="col-md-6 col-lg-6 col-12 mb-2">
                <input v-model="profesor" type="text" class="form-control" placeholder="Profes@r">
            </div>
            <div class="col-md-6 col-lg-6 col-12 mb-2">
                <button v-on:click="buscar()" class="btn btn-block btn-secondary">Buscar Consultas</button>
            </div>
        </div>
        <div class="row bg-light-gray p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-2 pt-1 row-consultas"
            v-if="sinConsultas">
            <div class="col-md-12 col-lg-12 col-12 mb-2">
                    <h3>No hay consultas disponibles</h3>
            </div>
        </div>
        <div class="row bg-light-gray p-md-3 p-lg-3 ml-md-3 mr-md-3 mt-md-2 pt-1 row-consultas" v-if="!sinConsultas">
            <div class="col-md-4 col-lg-4 col-12 mb-2">
                <datepicker :inline="true"
                            v-on:selected="selectFecha"
                            format="dd/mm/2019"
                            :disabled-dates="disabledDates"
                            v-model="fecha"
                            :highlighted="consultasFechas"
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
                    <span>Materia: @{{ this.consultaSeleccionada.materia }}</span><br>
                    <span>Profesor: @{{ this.consultaSeleccionada.profesor_apellido }},
                         @{{  this.consultaSeleccionada.profesor_nombre}}
                    </span><br>
                    <span>Fecha: @{{ this.fechaFormateada }}</span><br>
                    <span>Hora: @{{ this.consultaSeleccionada.hora }}</span><br>

                </div>
            </div>
            <div class="col-12 ">
                <div class="alert alert-danger" v-if="errorInscripcion">
                    Error al tratar de inscribir: @{{ this.response.msg }}
                </div>
                <div class="alert alert-success" v-if="consultaExitosa">
                    Inscripción exitosa: @{{ this.response.msg }}
                </div>
            </div>
            <div class="offset-md-3 offset-lg-3 col-md-6 col-lg-6 col-12 mb-2">
                <button v-on:click="inscripcionConfirmar()" class="btn btn-block btn-primary">Inscribirse</button>
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
      carreras: @json($carreras),
      materias: [],
      materia: '',
      profesor: '',
      consultas: [],
      fecha: null,
      fechaFormateada: '',
      horarios: [],
      url: '{{url('alumno/materias')}}',
      urlBuscar: '{{ url('alumno/buscar-consultas') }}',
      urlInscripcion: '{{ url('alumno/turnos-alumnos') }}',
      sinConsultas: false,
      horarioSeleccionado: null,
      consultaSeleccionada: null,
      errorInscripcion: false,
      consultaExitosa: false,
      response: {},
      consultasFechas: []
    },

    methods:{
      selectFecha(val) {
        this.fecha = val
        if (this.fecha) {
          this.fechaFormateada = this.fecha.getDate() + '/' + (this.fecha.getMonth()+1) + '/' + this.fecha.getFullYear();
          this.horarios = this.consultas.filter((c) => {
            return c.numero_dia == this.fecha .getDay()
          });
        }
      },
      selectHorario(consultaID) {
        this.horarioSeleccionado = true;
        const c = this.consultas.find((c) => {
          return c.id === consultaID
        });
        this.consultaSeleccionada = c;
      },
      getMaterias(){
        axios
          .get(`${this.url}/${this.carrera}`)
          .then(response => {
            this.materias = response.data
          })
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
              this.errorInscripcion = true;
            } else {
              this.consultaExitosa = true;
              this.clearForm();
            }
            Swal.hideLoading();
          },
            (error) => {
              Swal.hideLoading();

            })
      },
      buscar(){
        if (this.profesor === '' && this.materia === '') {
          // todo poner que falta validacion
          return false;
        }
        this.clearForm();
        const data = {
          profesor: this.profesor,
          materia: this.materia
        };
        axios
          .post(`${this.urlBuscar}`, data)
          .then(response => {
            this.sinConsultas = response.data.length <= 0;
            this.consultas = response.data
            this.consultasFechas = {
              days: this.consultas.map((c) => {
                return c.numero_dia
              })}
            console.log(this.consultas)
          })
      }
    },
    mounted(){
    },
    computed: {
      disabledDates: {
        get() {
          var self = this;
          return {
            to: new Date(), // Disable all dates up to specific date
            // from: new Date(2016, 0, 26), // Disable all dates after specific date
            days: [6, 0], // Disable Saturday's and Sunday's
            // todo poner dias sin clases
            // dates: [ // Disable an array of dates
                          //   new Date(2019, 10, 1),
                          //   new Date(2019, 10, 5),
                          //   new Date(2019, 10, 18)
            // ],
            customPredictor: function (date) {
              // disables the date if it is a multiple of 5
              if (typeof (self.consultas) != "undefined" && self.consultas.length > 0) {
                const d = self.consultas.find((c) => {
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
