app.controller("ingredientCrl", function ($scope, ingredienteService) {
    $scope.producto = null;
    $scope.ingrediente = null;
    $scope.ingredientes = [];

    $scope.getIngredientes = () => {
        ingredienteService.getByProductoId($scope.producto.id).then(response => {
            $scope.ingredientes = response.data;
        }, reject => {
            console.log("Error al obtener los productos: ", reject)
        });
    }

    $scope.addIngrediente = () => {
        $scope.ingrediente = {
            id_producto: $scope.producto.id
        }
    }

    $scope.editarIngrediente = ingrediente => {
        $scope.producto = {};
        angular.copy(ingrediente, $scope.ingrediente);
    }

    $scope.registrar = () => {
        console.log('data', $scope.ingrediente)
        ingredienteService.post($scope.ingrediente).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                        icon: 'success',
                        title: 'Ingrediente registrado',
                        showConfirmButton: false,
                        timer: 1300
                    }
                )
                $scope.ingrediente = null;
                $scope.getIngredientes();
            } else {
                Swal.fire(
                    {
                        icon: 'error',
                        title: 'El ingrediente no se registró',
                        showConfirmButton: false,
                        timer: 1300
                    }
                )
            }
        }, reject => {
            Swal.fire(
                {
                    icon: 'error',
                    title: 'Error al registrar el ingrediente',
                    showConfirmButton: false,
                    timer: 1300
                }
            )
        })
    }


    $scope.actualizar = () => {
        console.log('actualizar')
        ingredienteService.put($scope.ingrediente).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                        icon: 'success',
                        title: 'Ingrediente actualizado',
                        showConfirmButton: false,
                        timer: 1300
                    }
                )
                $scope.ingrediente = null;
                $scope.getIngredientes();
            } else {
                Swal.fire(
                    {
                        icon: 'error',
                        title: 'El Ingrediente no se actualizó',
                        showConfirmButton: false,
                        timer: 1300
                    }
                );
                $scope.usuario = null;
                $scope.getIngredientes();
            }
        }, reject => {
            Swal.fire(
                {
                    icon: 'error',
                    title: 'Error al actualizar el ingrediente',
                    showConfirmButton: false,
                    timer: 1300
                }
            )
        })
    }

    $scope.eliminar = ingrediente => {
        ingredienteService.delete(ingrediente).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                        icon: 'success',
                        title: 'Ingrediente eliminado',
                        showConfirmButton: false,
                        timer: 1300
                    }
                )

                $scope.getIngredientes();
            } else {
                Swal.fire(
                    {
                        icon: 'error',
                        title: 'El Ingrediente no se eliminó',
                        showConfirmButton: false,
                        timer: 1300
                    }
                )
            }
        }, reject => {
            Swal.fire(
                {
                    icon: 'error',
                    title: 'Error al eliminar el ingrediente',
                    showConfirmButton: false,
                    timer: 1300
                }
            )
        })
    }

    $scope.confirmDelete = ingrediente => {
        console.log('eliminar')
        Swal.fire({
            title: '¿Esta seguro que desea borrar el ingrediente?',
            text: ingrediente.nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $scope.eliminar(ingrediente);
            }
        })
    }
});