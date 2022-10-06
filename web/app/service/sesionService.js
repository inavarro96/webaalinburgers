angular.module('app').service('sesionService', function(httpFactory, $q) {
    
    const SELF = this;
    const URL = 'SesionController.php?action=';

    SELF.get = () => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}get`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            });
        });
    };

    SELF.destroy = () => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}destroy`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            });
        });
    };
});