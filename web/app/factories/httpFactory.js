app.factory("httpFactory", function($http, $q) {
    const URL = '/webalinburgers/app/controller/';

    return {
        get: (path) => {
            return $http({
				url : URL + path,
				method : "GET"
			}).then(function(response) {
				return  response.data
			}, function(response) {
				console.log(response);
				return $q.reject(response);
			});
        },
        getParams: (path, data) => {
            return $http({
				url : URL + path,
				method : "GET",
				params : data,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				return  response.data
			}, function(response) {
				console.error(response);
				return $q.reject(response);
			});
        },
        getFile:function(path, data){
			return $http({
				url : URL + path,
				method : "GET",
				params : $.param(data),
				responseType: 'arraybuffer',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {				
				return  response.data
			}, function(response) {
				console.error(response);
				return $q.reject(response);
			});
		},
        post: (path, data) => {
            return $http({
				url : URL + path,
				method : "POST",
				data :  $.param(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				return  response.data
			}, function(response) {
				console.error(response);
				return $q.reject(response);
			});
		}
    }
});