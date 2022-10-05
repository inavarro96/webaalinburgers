app.controller("pedidoCtrl", function($scope, pedidoService) {
    $scope.pedidos = [];
    $scope.pedido = {};
    $scope.productosPedido = [];
    $scope.totales = {};
    $scope.getPedidos = () => {
        pedidoService.getAll().then(response => {
            $scope.pedidos = response.data;
            console.log($scope.pedidos);
        }, reject => {
            console.log('Error al obtener los productos', reject)
        })
    };

    $scope.verDetallePedido = pedido => {
        $scope.pedido = pedido;
        $scope.pedido.visto = 1;
        $scope.getProductosByIdPedido(pedido.id);
    };

    $scope.atenderPedido = pedido => {
        pedido.atendido = 1;
        pedidoService.put(pedido).then(response => {
            Swal.fire(
                {
                 icon: 'success',
                 title: 'Pedido atendido',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        }, reject => {
            console.log('Error al obtener los productos', reject)
        })
    };

    $scope.getProductosByIdPedido = idPedido => {
        pedidoService.getProductosByIdPedido(idPedido).then(response => {
            $scope.productosPedido = response.data;
            console.log($scope.productosPedido);
            $scope.sumarProductosTotal();

        }, reject => {
            console.log('Error al obtener los productos', reject)
        })
    };
    $scope.sumarProductosTotal = () => {
        $scope.totales.total = 0;
        $scope.totales.cantidad = 0;

        for(let i in $scope.productosPedido) {
            
            $scope.totales.total += $scope.productosPedido[i].precio * $scope.productosPedido[i].cantidad;
            $scope.totales.cantidad += parseInt($scope.productosPedido[i].cantidad);
        }
    };

    angular.element(document).ready(function() {
        $scope.getPedidos();
    });
});