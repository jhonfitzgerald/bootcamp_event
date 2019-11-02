app.factory('organizerService', function($http) {
    return {
        getAll: function(params) {
            return $http.post('getallorganizers', params);
        },
        saveUpdate: function(params) {
            return $http.post('saveupdateorganizer', params);
        },
        delete: function(params) {
            return $http.post('deleteorganizer', params);
        }
    };
});
