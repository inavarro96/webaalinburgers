// Control de rutas de navegacion

app.config(function($locationProvider, $routeProvider) {
    $routeProvider
    // .when("/", {
    //     templateUrl:"/webaalinburgers/web/views/main.html",
    //     controller:"mainCtrl"
    // })
    .when("/productos", {
        templateUrl:"/webaalinburgers/web/views/producto.html",
        controller:"productoCtrl",
        activetab: "productos"
    })
    .when("/usuarios", {
        templateUrl:"/webaalinburgers/web/views/usuario.html",
        controller:"usuarioCtrl",
        activetab:"usuarios"
    })
    .when("/pedidos", {
        templateUrl:"/webaalinburgers/web/views/pedido.html",
        controller:"pedidoCtrl",
        activetab:"pedidos"
    })
    .when("/ventas", {
        templateUrl:"/webaalinburgers/web/views/ventas.html",
        controller:"ventasCtrl",
        activetab:"ventas"
    })
    .when("/estadisticas", {
        templateUrl:"/webaalinburgers/web/views/estadisticas.html",
        controller:"estadisticasCtrl",
        activetab:"estadisticas"
    })
    .when("/ingredientes/:id/:nombre", {
        templateUrl:"/webaalinburgers/web/views/ingrediente.html",
        controller:"ingredienteCtrl",
        activetab:"productos"

    })
    .when("/", {
        templateUrl:"/webaalinburgers/web/views/pedido.html",
        controller:"pedidoCtrl",
        activetab:"pedidos"
    });
}).run(function ($rootScope, $route) {
    $rootScope.$route = $route;
})
