app.controller("usuarioCtrl", function($scope) {
    $scope.usuario = null;

    $scope.init = () => {
        $scope.getUsuarios();
    }

    $scope.getUsuarios = () => {

    }

    $scope.addUsuario = () => {
        $scope.usuario = {
            fechaAlta: new Date()
        };
    }
    $scope.regresar = () => {
        $scope.usuario = null;
    }
    $scope.editarUsuario = () => {
        $scope.usuario = {id:1}
    }

    $scope.confirmDelete = () => {
        console.log('eliminar')
        Swal.fire({
            title: '¿Esta seguro que deseea borrar el usuario?',
            text: "Usuario",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
               {
                icon: 'success',
                title: 'Eliminado',
                showConfirmButton: false,
                timer: 1300
               }
              )
            }
          })
    }


});