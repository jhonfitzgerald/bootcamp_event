app.factory('categoryService', function($http) {
    return {
        getAll: function(params) {
            return $http.post('getallcategories', params);
        },
        saveUpdate: function(params) {
            return $http.post('saveupdatecategory', params);
        },
        delete: function(params) {
            return $http.post('deletecategory', params);
        }
    };
});
