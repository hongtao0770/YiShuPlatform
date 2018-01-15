angular.module('aboutUsModule',[])
    .controller('aboutUsCtrl',function($scope,$state){
        //返回按钮
        $scope.goBack = function () {
            $state.go('list.homePage');
        }
})