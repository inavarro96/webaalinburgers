app.controller('headerCtrl', function($scope, sesionService, sessionFactory, notificacionService) {

    sesionService.get().then(session => {
        sessionFactory.setList('user',session.data);
        $scope.user = sessionFactory.getList('user');

    }, error => {
        console.log('Error al obtener las sesiones', error);
    });

    $scope.getNotificaciones = () => {
        notificacionService.getAll().then(notificaciones => {
            console.log('notificaciones',notificaciones)
            $scope.notificaciones = [];
            $scope.notificacionesLength = 0;
            for(let i in notificaciones.data) {
                if(!notificaciones.data[i].visto) {
                    $scope.notificacionesLength += 1;
                    $scope.notificaciones.push(notificaciones.data[i]);
                }
               
            }
    
        }, error => {
            cconsole.log('Error al obtener las sesiones', error);
        });
    }
   

    $scope.viewNotificacion = idNotificacion => {
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

    angular.element(document).ready(function() {
        $scope.getNotificaciones();
    });

});