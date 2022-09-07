angular.module('app').service('usuarioService', function(httpFactory, $q) {
    
    const SELF = this;
    const URL = 'UsuarioController.php?action=';
    SELF.login = (data) => {
        return $q((resolve, reject) => {
            httpFactory.post(`${URL}login`, data).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        })
    };


    SELF.getAll = () => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}getAll`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

    SELF.post = (data) => {
        return $q((resolve, reject) => {
            httpFactory.post(`${URL}post`, data).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

    SELF.put = (data) => {
        return $q((resolve, reject) => {
            httpFactory.post(`${URL}put`, data).then(response => {
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