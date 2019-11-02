app.controller('organizerController', ['$rootScope', '$scope', 'organizerService', function($rootScope, $scope, organizerService) {
    $scope.page = { lisPage: [] };
    $scope.selectedItem = {};
    $scope.objectSelected = {};

    $scope.getAllItems = function() {
        $scope.page.lisPage = [];
        var params = {};
        organizerService.getAll(params).then(function(data) {
            if (data.data.length) {
                $scope.page.lisPage = data.data;
                $scope.clone = Object.assign({}, $scope.page);
                $rootScope.pager.objects = data.data;
                $rootScope.pager.pages = [];
                $rootScope.numberOfPages(data.data.length);
                $rootScope.pager.total = $rootScope.pager.objects.length;
            } else
                $scope.message = '<p class="badge badge-danger" style="font-size: 14px;margin: 0;">No se encontro Registro alguno (^_^)!!..</p>';
        });
    };

    $scope.select = function(input, type) {
        $scope.objectSelected = undefined;
        $scope.objectSelected = {};
        $scope.type = type;
        if (input != undefined) {
            $scope.objectSelected = input;
        } else {
            $scope.objectSelected.id = 0;
            $scope.objectSelected.name = "";
        }
    };

    $scope.saveUpdate = function() {
        var params = {
            item: $scope.objectSelected
        };
        organizerService.saveUpdate(params).then(function(data) {
            if (data.data.status === "true") {
                $.notify({
                    icon: 'fa fa-exclamation-triangle',
                    title: 'Satisfactorio!',
                    message: data.data.message,
                }, { type: 'success' });
                $scope.getAllItems();
            } else {
                $.notify({
                    icon: 'fa fa-exclamation-triangle',
                    title: 'Alerta!',
                    message: data.data.message,
                }, { type: 'danger' });
            }
        });
    };

    $scope.delete = function() {
        var params = {
            item: $scope.objectSelected
        };
        organizerService.delete(params).then(function(data) {
            if (data.data.status === "true") {
                $.notify({
                    icon: 'fa fa-exclamation-triangle',
                    title: 'Satisfactorio!',
                    message: data.data.message,
                }, { type: 'success' });
                $scope.getAllItems();
            } else {
                $.notify({
                    icon: 'fa fa-exclamation-triangle',
                    title: 'Alerta!',
                    message: data.data.message,
                }, { type: 'danger' });
            }
        });
    }

    $scope.action = function() {
        console.log('entroooo');
        if ($scope.type == 'save' || $scope.type == 'edit')
            $scope.saveUpdate();
        else if ($scope.type == 'delete')
            $scope.delete();
    };

    $scope.cancel = function() {
        $scope.seat = Object.assign({}, $scope.clone);
    };

    $scope.init = function() {
        $scope.getAllItems();
    }

    $scope.init();
}]);
