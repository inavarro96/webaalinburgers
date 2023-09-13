app.controller("usuarioCtrl", function($scope, usuarioService) {
    $scope.usuario = null;
    $scope.usuarios = [];

    $scope.getUsuarios = () => {
        usuarioService.getAll().then(response => {
            $scope.usuarios = response.data;
        }, reject => {
            console.log('Error al obtener los productos; ', reject);
        })
    }

    $scope.addUsuario = () => {
        $scope.usuario = {};
    }
    $scope.regresar = () => {
        $scope.usuario = null;
    }
    $scope.editarUsuario = usuario => {
        $scope.usuario = {};
        angular.copy(usuario, $scope.usuario);
    }

    $scope.submitForm = isValid => {
        console.log('submit', $scope.usuario)
        if(isValid) {
            if($scope.usuario.id) {
                $scope.actualizar();
            } else {
                $scope.registrar();
            }
        }
    };

    $scope.registrar = () => {
        console.log('data', $scope.usuario)
        usuarioService.post($scope.usuario).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'Usuario registrado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
                $scope.usuario = null;
                $scope.getUsuarios();
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El usuario no se registró',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al registrar el usuario',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    $scope.actualizar = () => {
        console.log('actualizar')
        usuarioService.put($scope.usuario).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'Usuario actualizado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
                   $scope.usuario = null;
                   $scope.getUsuarios();
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El usuario no se actualizó',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   );
                   $scope.usuario = null;
                   $scope.getUsuarios();
            }
        }, reject => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'Error al actualizar el usuario',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        })
    }

    $scope.eliminar = usuario => {
        usuarioService.delete(usuario).then( data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'Usuario eliminado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )

                   $scope.getUsuarios();
            } else {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'El usuario no se eliminó',
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

    $scope.confirmDelete = usuario => {
        console.log('eliminar')
        Swal.fire({
            title: '¿Esta seguro que desea borrar el usuario?',
            text: usuario.nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                $scope.eliminar(usuario);
            }
          })
    }

    const  init = () => {
        $scope.getUsuarios();
    }

    angular.element(document).ready(function() {
        init();
    });
});