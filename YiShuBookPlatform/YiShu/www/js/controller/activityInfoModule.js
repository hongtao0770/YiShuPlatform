angular.module('activityInfoModule',[])
    .controller('activityInfoCtrl',function($scope,$state,$ionicHistory,$ionicLoading,$timeout){

        //返回
        $scope.goback = function()
        {
            $ionicHistory.goBack();
        }



        $scope.activities = JSON.parse(localStorage.getItem("activity"));




    })