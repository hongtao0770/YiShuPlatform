angular.module('bookInfo2Module',[])
    .controller('bookInfo2Ctrl',function($scope,$state,$ionicLoading,$timeout){
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
            $scope.books = JSON.parse(localStorage.getItem("books2"));
            $ionicLoading.hide();
        }, 2000);


        //返回
        $scope.homePageBack = function () {
            $state.go('list.bookStore');
        }

        //去购买
        $scope.nextStep = function () {
            $state.go('ensureOrder2');
        }
})