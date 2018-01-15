angular.module('ezModule',[]).controller('ezCtrl',function($scope,$state){
   $state.go("login");
    apiRoot = 'http://localhost:8080/YiShuBookPlatform/service/Api/index.php/home/';
})
