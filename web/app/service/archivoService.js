angular.module('app').service('archivoService', function(httpFactory, $q){

    const SELF = this;
    const URL = 'ArchivoController.php?action=';
    SELF.postFoto = (data) => {
        return $q((resolve, reject) => {
            httpFactory.postFile(`${URL}post-foto`,data).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    }
});