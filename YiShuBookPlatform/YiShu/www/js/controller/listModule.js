angular.module('listModule',[]).controller('listCtrl',function($scope,$state){
    $scope.onTabSelected = function (index) {


        switch (index) {
            case 1:
                $state.go('list.homePage');
                break;
            case 2:
                $state.go('list.bookStore');
                break;
            case 3:
                $state.go('list.friendsCircle');
                break;
            case 4:
                $state.go('list.activity');
                break;
            default:
                break;
        }
    }
})