angular.module('app').service('ingredienteService', function (httpFactory, $q) {
    const SELF = this;
    const URL = 'IngredienteController.php?action='
    SELF.getAllByProductoId = (id) => {
        return $q((resolve, reject) => {
           httpFactory.get(`${URL}getByProductoId&id=${id}`).then(response => {
               resolve(response);
           }, error => {
               reject(error);
           });
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