// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionicLazyLoad','ngCordova','ionic','ezModule','loginModule','registerModule',
    'listModule','homePageModule','bookStoreModule','friendsCircleModule','activityModule'
,'forgetInfoModule','bookInfoModule','ensureOrderModule','orderModule','personalCenterModule'
,'myFriendModule','aboutUsModule','uploadheadModule','myNoticeModule','uploadBookModule'
,'bookInfo2Module','ensureOrder2Module','activityInfoModule','uploadRecordModule'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });

}).config(function($stateProvider,$urlRouterProvider){
    $stateProvider
        //登录
        .state("login",{
            cache: false,
            templateUrl:"template/login.html",
            controller:"loginCtrl",
        })

        //注册
        .state("register",{
            cache: false,
            templateUrl:"template/register.html",
            controller:"registerCtrl",
        })

        //最新图书详情
        .state("bookInfo",{
            cache: false,
            templateUrl:"template/bookInfo.html",
            controller:"bookInfoCtrl",
        })

        //选项卡
        .state('list', {
            cache:false,
            abstract:true,
            templateUrl: "template/list.html",
            controller:'listCtrl'
        })

        //忘记密码
        .state("forgetInfo",{
            cache: false,
            templateUrl:"template/forgetInfo.html",
            controller:"forgetInfoCtrl",
        })

        //我的订单
        .state("order",{
            cache: false,
            templateUrl:"template/order.html",
            controller:"orderCtrl",
        })

        //我的动态
        .state("myFriend",{
            cache: false,
            templateUrl:"template/myFriend.html",
            controller:"myFriendCtrl",
        })

        //确认订单
        .state("ensureOrder",{
            cache: false,
            templateUrl:"template/ensureOrder.html",
            controller:"ensureOrderCtrl",
        })

        //个人中心路由
        .state("personalCenter",{
            cache: false,
            templateUrl:"template/personalCenter.html",
            controller:"personalCenterCtrl",
        })

        //主界面
        .state('list.homePage', {
            views: {
                'homePage': {
                    cache:false,
                    templateUrl: 'template/homePage.html',
                    controller: 'homePageCtrl'
                }
            }
        })
        //书城
        .state('list.bookStore', {
            views: {
                'bookStore': {
                    cache:false,
                    templateUrl: 'template/bookStore.html',
                    controller: 'bookStoreCtrl'
                }
            }
        })
        //书友圈
        .state('list.friendsCircle', {
            views: {
                'friendsCircle': {
                    cache:false,
                    templateUrl: 'template/friendsCircle.html',
                    controller: 'friendsCircleCtrl'
                }
            }
        })
        //活动
        .state('list.activity', {
            views: {
                'activity': {
                    cache:false,
                    templateUrl: 'template/activity.html',
                    controller: 'activityCtrl'
                }
            }
        })

        //关于我们
        .state("aboutUs",{
            cache: false,
            templateUrl:"template/aboutUs.html",
            controller:"aboutUsCtrl",
        })

        //上传头像
        .state("uploadhead",{
            cache: false,
            templateUrl:"template/uploadhead.html",
            controller:"uploadheadCtrl",
        })

        //我的通知
        .state("myNotice",{
            cache: false,
            templateUrl:"template/myNotice.html",
            controller:"myNoticeCtrl",
        })

        //上传二手书
        .state("uploadBook",{
            cache: false,
            templateUrl:"template/uploadBook.html",
            controller:"uploadBookCtrl",
        })

        //二手书详情页面
        .state("bookInfo2",{
            cache: false,
            templateUrl:"template/bookInfo2.html",
            controller:"bookInfo2Ctrl",
        })


    //二手书确认订单
        .state("ensureOrder2",{
            cache: false,
            templateUrl:"template/ensureOrder2.html",
            controller:"ensureOrder2Ctrl",
        })

    //活动详情
        .state("activityInfo",{
            cache: false,
            templateUrl:"template/activityInfo.html",
            controller:"activityInfoCtrl",
        })

        //活动详情
        .state("uploadRecord",{
            cache: false,
            templateUrl:"template/uploadRecord.html",
            controller:"uploadRecordCtrl",
        })

    })

