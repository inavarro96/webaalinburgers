app.controller("pedidoCtrl", function($scope, pedidoService) {
    $scope.pedidos = [];
    $scope.pedido = {};
    $scope.productosPedido = [];
    $scope.totales = {};
    $scope.idsSelected = [];
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

    $scope.selectedPedido =(idPedido, statusCheck) => {
        statusCheck = !statusCheck;
        if(statusCheck) {
            $scope.idsSelected.push(idPedido);
        } else {
            $scope.idsSelected = $scope.idsSelected.filter(id => id != idPedido);
        }

    }

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

    $scope.confirmDeleteSelected = () => {
        Swal.fire({
            title: '¿Esta seguro que desea borrar los pedidos',
            text: 'Seleccionados?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                $scope.eliminarSelected();
            }
          })
    }

    $scope.eliminarSelected = () => {

        idString = {ids: $scope.idsSelected.toString()}
        pedidoService.deleteSelected(idString).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'Pedidos eliminados',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )

                   $scope.getPedidos();
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'Ha ocurrido un error al eliminar',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al eliminar el usuario',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    angular.element(document).ready(function() {
        $scope.getPedidos();
    });
});