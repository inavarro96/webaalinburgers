app.controller("estadisticasCtrl", function ($scope, pedidoService) {
    $scope.productos = [];

    $scope.formModel = {
        formSearchFirtsDate: new Date(),
        formSearchEndDate: new Date()
    };


    $scope.getProductosVendidos = () => {
        console.log($scope.formModel);
        $scope.fechaInicio = $scope.formModel.formSearchFirtsDate.toJSON();
        $scope.fechaFin = $scope.formModel.formSearchEndDate.toJSON();
        pedidoService.getEstadisticasProductoAndFechaBetween(
            $scope.fechaInicio,
            $scope.fechaFin
        ).then(response => {
            $scope.productos = [];

            Object.keys(response.data).forEach(j => {
               $scope.productos.push(response.data[j]);
            });
            console.log($scope.productos);
        }, reject => {
            console.log('Error al obtener las estatisticas')
        })
    };

    angular.element(document).ready(function() {
        $scope.getProductosVendidos();
    });

});