<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Eventos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="../css/eventos.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Eventos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                </ul>
                <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
    </nav>

    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">

                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Blog post-->

                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"> {{$evento -> city }} {{$evento -> address }} {{$evento -> date }}</div>
                                <h2 class="card-title h4"> {{$evento -> name }}</h2>
                                <p class="card-text">@foreach ( $categorias as $categoria)
                                    @if($evento->categoria_id==$categoria->id)
                                    {{$categoria->name}}
                                    @endif
                                    @endforeach
                                </p>
                                <div class="small text"> {{$evento -> description }}</div>
                                <form class="form-inline" action="/eventos/inscribir/usuario" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                                    <input type="hidden" name="evento_id" value="{{ $evento->id}}" >
                                    <input type="hidden" name="estado" value="RECIBIDA" >
                                    <label for="numEntradas">Cantidad de entradas:</label>
                                    <select name="numEntradas" id="numEntradas">
                                        <option value="1">1</option>
                                        <option value="2" selected> 2</option>
                                        <option value="3"> 3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected> 5</option>
                                        
                                    </select>
                                    <button type="submit" class="btn btn-primary">Inscribirse</button>
                                </form>
                                <a class="btn btn-warning" href="/eventos/{{ $evento->id}}/desinscribir/{{Auth::user()->id}}">Desinscribirme →</a>
                                @foreach($usuarios as $u)
                                {{$u -> name}}
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- BUSCAR POR FECHA  -->
                <form class="form-inline" action="/eventos/buscarFecha" method="post">
                    @csrf
                    <input name="date" class="form-control mr-sm-2" type="date" placeholder="Buscar por " aria-label="Search">

                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
                <!-- BUSCAR POR CIUDAD  -->
                <form class="form-inline" action="/eventos/buscarCiudad" method="post">
                    @csrf
                    <input name="city" class="form-control mr-sm-2" type="text" placeholder="Buscar por ciudad " aria-label="Search">

                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
                <!-- BUSCAR POR CATEGORIA  -->
                <form class="form-inline" action="/eventos/buscarCategoria" method="post">
                    @csrf
                    <input name="buscarCategoria" class="form-control mr-sm-2" type="text" placeholder="Buscar por categoria " aria-label="Search">

                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>

                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="card-text">@foreach ( $categorias as $categoria)

                                        {{$categoria->name}}
                                        <br>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="card-text">@foreach ( $categorias as $categoria)

                                        {{$categoria->name}}
                                        <br>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Calendario</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Guillermo Jabalera Pérez</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>