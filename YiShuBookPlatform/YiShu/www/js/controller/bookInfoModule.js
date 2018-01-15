angular.module('bookInfoModule',[])
    .controller('bookInfoCtrl',function($scope,$state,$ionicLoading,$timeout,$ionicHistory){

        //加载
        $ionicLoading.show({
            template: '<ion-spinner icon="ios-small"></ion-spinner>',
            content: 'Loading',
            animation: 'fade-in',
            showBackdrop: true,
            maxWidth: 200,
            showDelay: 0
        });


        $timeout(function () {
            $scope.books = JSON.parse(localStorage.getItem("books1"));
            $ionicLoading.hide();
        }, 2000);


        //返回
        $scope.homePageBack = function () {
            if(localStorage.getItem("tabs") == 0)
            {
                $state.go('list.homePage');
            }else if(localStorage.getItem("tabs") == 1)
            {
                $state.go('list.bookStore');
            }

        }
        
        //去购买
        $scope.nextStep = function () {
            $state.go('ensureOrder');
        }
})