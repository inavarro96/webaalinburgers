angular.module('app').service('notificacionService', function(httpFactory, $q) {

    const SELF = this;
    const URL = 'NotificacionController.php?action=';

    SELF.getAll = (idUsuario) => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}getAll&idUsuario=${idUsuario}`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

    SELF.delete = (data) => {
        return $q((resolve, reject) => {
            httpFactory.post(`${URL}delete`, data).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

});