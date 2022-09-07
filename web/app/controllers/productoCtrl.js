app.controller("productoCtrl", function($scope, productoService) {
    $scope.producto = null;
    $scope.productos = [];

    

    $scope.getProductos = () => {
        productoService.getAll().then(response => {
            $scope.productos = response.data;
        }, reject => {
            console.log('Error al obtener los productos; ', reject);
        });
    }

    $scope.addProducto = () => {
        $scope.producto = {
            fechaAlta: new Date()
        };
    }
    $scope.regresar = () => {
        $scope.producto = null;
    }
    $scope.editarProducto = producto => {
        $scope.producto = {};
        angular.copy(producto, $scope.producto)
    }

    $scope.submitForm = isValid => {
        if(isValid) {
            if($scope.producto.id) {
                $scope.actualizar();
            } else {
                $scope.registrar();
            }
        }
    }

    $scope.registrar = () => {
        productoService.post($scope.producto).then(data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'Producto registrado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El producto no se registró',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al registrar el producto',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    $scope.actualizar = () => {
        productoService.put($scope.alumno).then(data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'producto actualizado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El producto no se actualizó',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al actualizar el producto',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    $scope.eliminar = producto => {
        productoService.delete(producto).then(data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'producto eliminado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El producto no se eliminó',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al eliminar el producto',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    $scope.confirmDelete = producto => {
        console.log('eliminar')
        Swal.fire({
            title: '¿Esta seguro que deseea borrar el producto?',
            text: producto.nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                $scope.eliminar(producto);
            }
          })
    }

    const init = () => {
        $scope.getProductos();
    }
    angular.element(document).ready(function() {
        init();
    });
});