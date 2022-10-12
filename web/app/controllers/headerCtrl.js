app.controller('headerCtrl', function($scope, sesionService, sessionFactory, notificacionService, $location) {

    $scope.cantidadNotificaciones = 0;
    sesionService.get().then(session => {
        sessionFactory.setList('user',session.data);
        $scope.user = sessionFactory.getList('user');

    }, error => {
        console.log('Error al obtener las sesiones', error);
    });

    $scope.getNotificaciones = () => {
        $scope.user = sessionFactory.getList('user');
        notificacionService.getAll($scope.user.id).then(notificaciones => {
          
            $scope.notificaciones = [];
            $scope.notificacionesLength = 0;
            for(let i in notificaciones.data) {
                if(!notificaciones.data[i].visto) {
                    $scope.notificacionesLength += 1;
                    $scope.notificaciones.push(notificaciones.data[i]);
                }
               
            }
            if($scope.notificacionesLength > $scope.cantidadNotificaciones) {
                let i = $scope.notificacionesLength-1
                $scope.createPushNotificacion (notificaciones.data[i].asunto, notificaciones.data[i].descripcion)
            }
            $scope.cantidadNotificaciones = $scope.notificacionesLength;
        }, error => {
            console.log('Error al obtener las sesiones', error);
        });
    }
   

    $scope.viewNotificacion = idNotificacion => {
        $scope.user = sessionFactory.getList('user');
        let send = { idNotificacion,
            idUsuario: $scope.user.id
         };

         notificacionService.delete(send).then(data => {
            console.log('data', data);
            $scope.getNotificaciones();
        }, error => {
            console.log('Error al cerrar la sesión',error);
        })
    }

    $scope.destroy = () => {
        sesionService.destroy().then(session => {
            sessionFactory.clear();
            location.reload();
        }, error => {
            console.log('Error al cerrar la sesión',error);
        })
    };

    $scope.createPushNotificacion = (asunto, descripcion) => {
        Push.create(asunto, {
            body: descripcion,
            icon: '../../img/icon.png',
            timeout: 5000,
            vibrate:[100,100,100],
            onclick: function() {
                $location.path('/pedidos');
            } 
        });
    }

    angular.element(document).ready(function() {
        $scope.getNotificaciones();
        
    });

    setInterval(function(){ 
        $scope.getNotificaciones() 
       }, 5000);
});