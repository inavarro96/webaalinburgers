app.controller("productoCtrl", function($scope) {
    $scope.producto = null;

    $scope.init = () => {
        $scope.getProductos();
    }

    $scope.getProductos = () => {

    }

    $scope.addProducto = () => {
        $scope.producto = {
            fechaAlta: new Date()
        };
    }
    $scope.regresar = () => {
        $scope.producto = null;
    }
    $scope.editarProducto = () => {
        $scope.producto = {id:1}
    }

    $scope.confirmDelete = () => {
        console.log('eliminar')
        Swal.fire({
            title: '¿Esta seguro que deseea borrar el producto?',
            text: "Amburguesa",
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