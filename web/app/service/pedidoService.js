angular.module('app').service('pedidoService', function(httpFactory, $q) {
    const SELF = this;
    const URL = 'PedidoController.php?action=';

    SELF.getAll = () => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}getAll`).then(response => {
                resolve(response);
            }, error => {
                reject(error);
            })
        });
    };

    SELF.getProductosByIdPedido = (idPedido) => {
        return $q((resolve, reject) => {
            httpFactory.get(`${URL}getProductosByIdPedido&id_pedido=${idPedido}`).then(response => {
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
});