<?php
session_start();
  if(!isset($_SESSION['user'])){
   header('Location: ./../');
  }
?>

<!DOCTYPE html>
<html lang="es" ng-app="app">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Alin Burgers Admin</title>
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"
        />
        <!-- Google Fonts Roboto -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
        />
        <!-- MDB -->
        <link rel="stylesheet" href="css/mdb.min.css" />
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/admin.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.3/cropper.css">
    </head>

    <body>
        <!--Main Navigation-->
        <header ng-controller="headerCtrl">
            <!-- Sidebar -->
            <nav
                id="sidebarMenu"
                class="collapse d-lg-block sidebar collapse bg-white"
            >
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4">

                        <a
                            href="#!/pedidos"
                            ng-class="{'active': $route.current.activetab == 'pedidos'}"
                            class="list-group-item list-group-item-action py-2 ripple"
                            ><i class="fas fa-money-bill fa-fw me-3"></i
                            ><span>Pedidos</span></a
                        >
                        <a ng-if="user.perfil == 1"
                           ng-class="{'active': $route.current.activetab == 'productos'}"
                           href="#!/productos"
                           class="list-group-item list-group-item-action py-2 ripple"
                        >
                            <i class="fas fa-chart-area fa-fw me-3"></i
                            ><span>Productos</span>
                        </a>
                        <a
                            href="#!/usuarios" ng-if="user.perfil == 1"
                            ng-class="{'active': $route.current.activetab == 'usuarios'}"
                            class="list-group-item list-group-item-action py-2 ripple"
                            ><i class="fas fa-users fa-fw me-3"></i
                            ><span>Usuarios</span></a
                        >
                        <a
                                href="#!/ventas" ng-if="user.perfil == 1"
                                ng-class="{'active': $route.current.activetab == 'ventas'}"
                                class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-book fa-fw me-3"></i
                            >
                            <span>Consulta ventas</span></a>
                        <a
                                href="#!/estadisticas" ng-if="user.perfil == 1"
                                ng-class="{'active': $route.current.activetab == 'estadisticas'}"
                                class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-chart-line fa-fw me-3"></i>
                            <span>Estadísticas</span></a>

                    </div>
                </div>
            </nav>
            <!-- Sidebar -->

            <!-- Navbar -->
            <nav
                id="main-navbar"
                class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
            >
                <!-- Container wrapper -->
                <div class="container-fluid">
                    <!-- Toggle button -->
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#sidebarMenu"
                        aria-controls="sidebarMenu"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Brand -->
                    <a class="navbar-brand" href="">
                        Alien Burgers
                    </a>

                    <!-- Right links -->
                    <ul class="navbar-nav ms-auto d-flex flex-row">
                        <!-- Notification dropdown -->
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
                                href="#"
                                id="navbarDropdownMenuNotificacion"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <i class="fas fa-bell"></i>
                                <span ng-if="notificacionesLength"
                                    class="badge rounded-pill badge-notification bg-danger"
                                    >{{notificacionesLength}}</span
                                >
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdownMenuNotificacion"
                            >
                                <li ng-repeat="notificacion in notificaciones">
                                    <a class="dropdown-item" href="#!/pedidos"
                                        ng-click="viewNotificacion(notificacion.id)"
                                        >{{notificacion.asunto}}</a
                                    >
                                </li>


                            </ul>
                        </li>

                        <!-- Avatar -->
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                                href="#"
                                id="navbarDropdownMenuUser"
                                role="button"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false"
                            >
                            <i class="fas fa-user-alt"></i>
                            {{user.nombre+' '+user.apellidos}}
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdownMenuUser"
                            >
                                <li>
                                    <a class="dropdown-item" href="" ng-click="destroy()"
                                        ><i class="fas fa-outdent"></i> Cerrar Sesión</a
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->
        </header>
        <!--Main Navigation-->

        <!--Main layout-->
        <main style="margin-top: 58px">
            <div class="container pt-4" ng-view></div>
        </main>
        <!--Main layout-->
        <footer class="bg-light text-lg-start">
            <hr class="m-0" />

            <!-- Copyright -->
            <div
                class="text-center p-3"
                style="background-color: rgba(0, 0, 0, 0.2)"
            >
                © 2022 - 2023 Copyright:
                <a class="text-dark" href="#">Alin Burgers</a>
            </div>
            <!-- Copyright -->
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Angular -->
        <script src="js/angular.min.js"></script>
        <!-- Angular route -->
        <script src="js/angular-route.mim.js"></script>
        <!-- Sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Angular Modules -->
        <script src="app/modules/app.js"></script>
        <script src="app/modules/router.js"></script>
        <!-- Angular directives -->
        <script src="app/directives/fileInputDirective.js"></script>
        <!-- Angular factories -->
        <script src="app/factories/httpFactory.js"></script>
        <script src="app/factories/sessionFactory.js"></script>

        <!-- Angular services -->
        <script src="app/service/productoService.js"></script>
        <script src="app/service/usuarioService.js"></script>
        <script src="app/service/pedidoService.js"></script>
        <script src="app/service/archivoService.js"></script>
        <script src="app/service/sesionService.js"></script>
        <script src="app/service/notificacionService.js"></script>
        <script src="app/service/ingredienteService.js"></script>

        <!-- Angular controllers -->
        <script src="app/controllers/headerCtrl.js"></script>
        <script src="app/controllers/mainCtrl.js"></script>
        <script src="app/controllers/productoCtrl.js"></script>
        <script src="app/controllers/usuarioCtrl.js"></script>
        <script src="app/controllers/pedidoCtrl.js"></script>
        <script src="app/controllers/ingredienteCtrl.js"></script>
        <script src="app/controllers/ventasCtrl.js"></script>
        <script src="app/controllers/estadisticasCtrl.js"></script>
        <script src="js/push.min.js"></script>
        <script>
            window.onload = function() {
                Push.Permission.request();
            }
        </script>
    </body>
</html>
