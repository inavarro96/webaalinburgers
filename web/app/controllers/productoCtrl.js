app.controller("productoCtrl", function($scope, $location, productoService, archivoService) {
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
        $scope.producto = {};
    }
    $scope.regresar = () => {
        $scope.producto = null;
    }
    $scope.editarProducto = producto => {
        $scope.producto = {};
        angular.copy(producto, $scope.producto)
    }

    $scope.submitForm = isValid => {
        console.log('sub')
        if(isValid) {
            if($scope.producto.id) {
                $scope.actualizar();
            } else {
                $scope.registrar();
            }
        }
    }


    $scope.registrar = () => {
       $scope.uploadFoto =document.getElementById("idUploadFoto").src;
        $scope.producto.uploadFoto = $scope.dataURLtoFile($scope.uploadFoto);
        let fd = new FormData();
        fd.append('imagen', $scope.producto.uploadFoto);

        archivoService.postFoto(fd).then(response => {
            console.log($scope.producto);
            $scope.producto.imagen = response.data;
            $scope.producto.uploadFoto = null;
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
                       $scope.producto = null;
                        document.getElementById("result").innerHTML=null;
                       $scope.getProductos();
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
        }, error => {
            Swal.fire(
                {
                 icon: 'error',
                 title: 'No se subió la foto',
                 showConfirmButton: false,
                 timer: 1300
                }
               )
        });

        
    }

    $scope.actualizar = () => {

        if(document.getElementById("idUploadFoto")) {
            $scope.uploadFoto =document.getElementById("idUploadFoto").src;
            $scope.producto.uploadFoto = $scope.dataURLtoFile($scope.uploadFoto);
            let fd = new FormData();
            fd.append('imagen', $scope.producto.uploadFoto);
            archivoService.postFoto(fd).then(response => {
                $scope.producto.imagen = response.data;
                $scope.producto.uploadFoto = null;
                document.getElementById("result").innerHTML=null;
                $scope.actualizarProducto();
            }, reject => {
                Swal.fire(
                    {
                     icon: 'error',
                     title: 'No se subió la foto',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
            })
        } else {
            $scope.actualizarProducto();
        }
    }

    $scope.actualizarProducto = () => {
        productoService.put($scope.producto).then(data => {
            if(data.data) {
                Swal.fire(
                    {
                     icon: 'success',
                     title: 'producto actualizado',
                     showConfirmButton: false,
                     timer: 1300
                    }
                   )
                   $scope.producto= null;
                   $scope.getProductos();
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
                   $scope.getProductos();
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

    $scope.showIngredientes = (producto) => {
        console.log('producto', producto)
        $location.path('ingredientes/'+producto.id+'/'+producto.nombre);
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

    $scope.dataURLtoFile = dataurl => {
        let arr = dataurl.split(',');
        let mime = arr[0].match(/:(.*?);/)[1];
        let bstr = atob(arr[arr.length - 1]);
        let n =  bstr.length;
        let u8arr = new Uint8Array(n);

        while( n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], 'fotoImage.png', {type:mime});
    };

});