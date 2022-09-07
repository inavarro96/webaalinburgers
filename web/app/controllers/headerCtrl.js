app.controller('headerCtrl', function($scope, sesionService, sessionFactory) {

    sesionService.get().then(session => {
        sessionFactory.setList('user',session.data);
        $scope.user = sessionFactory.getList('user');

    }, error => {
        cconsole.log('Error al obtener las sesiones', error);
    });

    $scope.destroy = () => {
        sesionService.destroy().then(session => {
            sessionFactory.clear();
            location.reload();
        }, error => {
            console.log('Error al cerrar la sesión',error);
        })
    }
});