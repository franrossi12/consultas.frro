@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")
    <div class="card shadow-lg container-fluid contenido mt-3 mb-3">
        <div class="row">
            <div class="col-2 card-header m-3" style="height:100%">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Noticias</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Nueva consulta</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Eventos del mes</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Eventos de la semana</a>
                </div>
            </div>
            <div class="col-9 card-body">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <!-- Inicio card 1-->
                        <div class="card shadow-lg mt-2 mb-2" style="width: 100%;">
                            <div class="mt-2 mb-2 shadow-lg">
                                <button class="btn col-md-12 cardButton bg-light text-dark" type="buton" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    <div class="row">
                                        <div class="col-md-11 text-left">
                                            <i class="fas fa-female"></i> colo maraca
                                        </div>
                                        <div class="col-md-1">
                                            <i class="flecha fas fa-angle-down"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="collapse" id="collapseExample1">
                                <div class="card card-body">
                                    <div class="20">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores modi nulla assumenda odio corrupti repudiandae aliquam deleniti est recusandae. Nobis ea veniam rerum dolorem doloremque optio quas officia hic recusandae?</div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin card -->

                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <!-- nueva consulta-->

                        <div class="card mt-5">
                            <div class="card-header">
                                <form>
                                    <!-- seleccion de materia -->
                                    <div class="form-group row">
                                        <label for="matInput" class="col-2 col-form-label">Materia</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="matInput" placeholder="Ingrese el nombre de la materia" required>
                                        </div>
                                    </div>
                                    <!-- seleccion de docente -->
                                    <div class="form-group row">
                                        <label for="docInput" class="col-2 col-form-label">Docente</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="docInput" placeholder="Ingrese el nombre del docente" required>
                                        </div>
                                    </div>
                                    <!-- fecha deseada -->
                                    <div class="form-group row">
                                        <label for="dateInput" class="col-2 col-form-label">Fecha deseada</label>
                                        <div class="col-10">
                                            <input class="form-control" type="date" id="dateInput" required>
                                        </div>
                                    </div>
                                    <!-- select hora y salon -->
                                    <div class="form-group row">
                                        <label for="hourInput" class="col-2 col-form-label">Horario y salon</label>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <select class="form-control" id="disponibles" required>
                                                    <option value="">Disponibles</option>
                                                    <option>hora 1 salon 1</option>
                                                    <option>hora 2 salon 2</option>
                                                    <option>hora 3 salon 3</option>
                                                    <option>hora 4 salon 4</option>
                                                    <option>hora 5 salon 5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success col-md-11 m-3 ">ACEPTAR</button>
                            </div>
                            </form>
                        </div>
                        <!-- nueva consulta-->
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <!-- calendario -->
                        <div class="container-fluid">
                            <header>
                                <h4 class="display-4 mb-4 text-center">November 2017</h4>
                                <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                                    <h5 class="col-sm p-1 text-center">Sunday</h5>
                                    <h5 class="col-sm p-1 text-center">Monday</h5>
                                    <h5 class="col-sm p-1 text-center">Tuesday</h5>
                                    <h5 class="col-sm p-1 text-center">Wednesday</h5>
                                    <h5 class="col-sm p-1 text-center">Thursday</h5>
                                    <h5 class="col-sm p-1 text-center">Friday</h5>
                                    <h5 class="col-sm p-1 text-center">Saturday</h5>
                                </div>
                            </header>
                            <div class="row border border-right-0 border-bottom-0">
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">29</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">30</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">31</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">1</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">2</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">3</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Test Event 1">Test Event 1</a>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">4</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">5</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">6</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">7</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">8</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white" title="Test Event 2">Test Event 2</a>
                                    <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white" title="Test Event 3">Test Event 3</a>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">9</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">10</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">11</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">12</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">13</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">14</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">15</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">16</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">17</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">18</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">19</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">20</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-primary text-white" title="Test Event with Super Duper Really Long Title">Test Event with Super Duper Really Long Title</a>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">21</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">22</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">23</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">24</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">25</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">26</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">27</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">28</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">29</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">30</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">1</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">2</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">3</span>
                                        <small class="col d-sm-none text-center text-muted">Sunday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">4</span>
                                        <small class="col d-sm-none text-center text-muted">Monday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">5</span>
                                        <small class="col d-sm-none text-center text-muted">Tuesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">6</span>
                                        <small class="col d-sm-none text-center text-muted">Wednesday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">7</span>
                                        <small class="col d-sm-none text-center text-muted">Thursday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">8</span>
                                        <small class="col d-sm-none text-center text-muted">Friday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                                    <h5 class="row align-items-center">
                                        <span class="date col-1">9</span>
                                        <small class="col d-sm-none text-center text-muted">Saturday</small>
                                        <span class="col-1"></span>
                                    </h5>
                                    <p class="d-sm-none">No events</p>
                                </div>
                            </div>
                        </div>
                        <style>
                            @media (max-width:575px) {
                                .display-4 {
                                    font-size: 1.5rem;
                                }

                                .day h5 {
                                    background-color: #f8f9fa;
                                    padding: 3px 5px 5px;
                                    margin: -8px -8px 8px -8px;
                                }

                                .date {
                                    padding-left: 4px;
                                }
                            }

                            @media (min-width: 576px) {
                                .day {
                                    height: 10vw;
                                }
                            }
                        </style>
                        <!-- calendario -->
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <!-- Inicio card 1-->
                        <div class="card shadow-lg mt-2 mb-2" style="width: 100%;">
                            <div class="mt-2 mb-2 shadow-lg">
                                <button class="btn col-md-12 cardButton bg-light text-dark" type="buton" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    <div class="row">
                                        <div class="col-md-11 text-left">
                                            <i class="fas fa-female"></i> juan maraca
                                        </div>
                                        <div class="col-md-1">
                                            <i class="flecha fas fa-angle-down"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="collapse" id="collapseExample1">
                                <div class="card card-body">
                                    <div class="20">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores modi nulla assumenda odio corrupti repudiandae aliquam deleniti est recusandae. Nobis ea veniam rerum dolorem doloremque optio quas officia hic recusandae?</div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin card -->
                    </div>
                </div>
            </div>
        </div>
    </div>







  <script type="text/javascript">
        $(".cardButton").click(function() {
            $(this).toggleClass("bg-light bg-dark");
            $(this).toggleClass("text-dark text-white");
            $(this).children("div").children("div").children("i").toggleClass("fa-angle-down fa-angle-up");
        });
    </script>

@endsection
