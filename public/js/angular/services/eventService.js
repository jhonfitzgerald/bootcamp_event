app.factory('eventService', function($http) {
    return {
        getAll: function(params) {
            return $http.post('getallevents', params);
        },
        saveUpdate: function(params) {
            return $http.post('saveupdateevent', params);
        },
        delete: function(params) {
            return $http.post('deleteevent', params);
        }
    };
});
