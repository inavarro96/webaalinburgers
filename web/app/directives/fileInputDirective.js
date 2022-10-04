app.directive("fileModel", function($parse){
    return{
        link: function($scope, element, attrs){
            element.on("change", function(event){
                let files = event.target.files;
                $parse(attrs.fileModel).assign($scope, element[0].files[0]);
                $scope.$apply();
            });
        }
    }
});