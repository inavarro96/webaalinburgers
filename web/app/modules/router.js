// Control de rutas de navegacion

app.config(['$locationProvider','$routeProvider', function($locationProvider, $routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl:"/web/views/main.html",
        controller:"mainCtrl"
    })
    .when("/productos", {
        templateUrl:"/web/views/producto.html",
        controller:"productoCtrl"
    })
    .when("/usuarios", {
        templateUrl:"/web/views/usuario.html",
        controller:"usuarioCtrl"
    })
    .when("/pedidos", {
        templateUrl:"/web/views/pedido.html",
        controller:"pedidoCtrl"
    })
    .otherwise({directTo: '/'})
}]);
