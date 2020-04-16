<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Prueba Tecnica - Ing. Jaime Angulo">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Prueba Tecnica - Ing. Jaime Angulo Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Prueba Tecnica - Ing. Jaime Angulo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
       
     
    </header>

    <div class="app-body">
        
        @include('plantilla.sidebar')
        <!-- Contenido Principal -->
        @yield('contenido')
        <!-- /Fin del contenido principal -->
    </div>   
    </div>
    <footer class="app-footer">
        <span><a href="https://www.linkedin.com/in/jaime-angulo-37440165/">Ing.jaime Angulo</a> &copy; 2020</span>
        <span class="ml-auto">Desarrollado por <a href="https://www.linkedin.com/in/jaime-angulo-37440165/">>Ing.jaime Angulo</a></span>
    </footer>
    

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>