angular.module('ezModule',[]).controller('ezCtrl',function($scope,$state){
   $state.go("login");
    // $state.go("register");
  //$state.go("list.homePage");
    // $state.go("list.bookStore");
    //$state.go('bookInfo');
   //$state.go('bookInfo2');
   //$state.go('list.friendsCircle');
    //$state.go('list.activity');
    //$state.go('ensureOrder');
    //$state.go('ensureOrder2');
    //$state.go('order');
     //$state.go('personalCenter');
    //$state.go('myFriend');
    //$state.go('aboutUs');
    //$state.go('forgetInfo');
    //$state.go('uploadhead');
     //$state.go('myNotice');
    // $state.go('uploadBook');
   // $state.go('linkAdmin');
   //$state.go('activityInfo');
   //  $state.go('uploadRecord');
   //  192.168.43.253
    apiRoot = 'http://localhost:8080/YiShuBookPlatform/service/Api/index.php/home/';
})