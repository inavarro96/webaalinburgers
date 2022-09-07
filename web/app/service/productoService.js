angular.module('app').service('productoService', function(httpFactory, $q) {
    
    const SELF = this;
    const URL = 'ProductoController.php?action=';

    SELF.getAll = () => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}get`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

    SELF.getById = (id) => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}getById&id=${id}`).then(response => {
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