// Control de rutas de navegacion

app.config(['$locationProvider','$routeProvider', function($locationProvider, $routeProvider) {
    $routeProvider
    // .when("/", {
    //     templateUrl:"/webaalinburgers/web/views/main.html",
    //     controller:"mainCtrl"
    // })
    .when("/productos", {
        templateUrl:"/webaalinburgers/web/views/producto.html",
        controller:"productoCtrl"
    })
    .when("/usuarios", {
        templateUrl:"/webaalinburgers/web/views/usuario.html",
        controller:"usuarioCtrl"
    })
    .when("/pedidos", {
        templateUrl:"/webaalinburgers/web/views/pedido.html",
        controller:"pedidoCtrl"
    })
    .otherwise({directTo: '/productos'})
}]);
