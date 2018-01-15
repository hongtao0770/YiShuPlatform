angular.module('homePageModule',[]).controller('homePageCtrl',function($scope,$state,
         $ionicSideMenuDelegate,$ionicLoading,$timeout,$ionicPopup){

    //修改图片初始位置
    $scope.activeSlide = 0;

    // //加载页面
    // $ionicLoading.show({
    //     template: '<ion-spinner icon="ios-small"></ion-spinner>',
    //     content: 'Loading',
    //     animation: 'fade-in',
    //     showBackdrop: true,
    //     maxWidth: 200,
    //     showDelay: 0
    // });

    //打开侧栏
    $scope.toGoLeft =function(){
        $ionicSideMenuDelegate.toggleLeft();
    }

    //获取推荐图书信息
    getBookCard();


    //获取用户信息
    $scope.users = JSON.parse(localStorage.getItem("user"));
    console.log($scope.users);


    //获取排行榜信息
    getRank();

    function getRank() {
        $.ajax({
            url:apiRoot+'book/getRank',
            type:'post',

            success:function (data, status) {
                //console.log(data.content);
                $scope.bookRank = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    //去图书详细信息
    $scope.goBookInfoWithId = function(index)
    {
        //console.log(index);

        localStorage.setItem("books1", JSON.stringify($scope.bookcards[index]));
        localStorage.setItem("tabs", 0);
        //console.log( localStorage.setItem("books1", JSON.stringify($scope.bookcards[index])));
        $state.go('bookInfo');

    }


    // $timeout(function () {
    //
    //     $ionicLoading.hide();
    //
    // }, 2000);

    //下拉刷新
    $scope.doRefresh = function() {
            console.log('刷新首页数据');
            getCount();
            getBookCard();
            getRank();
            $scope.$broadcast("scroll.refreshComplete");
    };


    //获取推荐图书函数
  function getBookCard () {
        var bookShow = 1;
        $.ajax({
            url:apiRoot+'book/getBookCard',
            type:'post',
            data:{
                bookShow:bookShow
            },
            success:function (data, status) {
                //console.log(data);
                $scope.bookcards = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    //排行榜 - > 图书详情
    $scope.getbookinfo = function (index) {
        //console.log($scope.bookRank[index].bookid);
        $.ajax({
            url:apiRoot+'book/getBooksById',
            type:'post',
            data:{
                bookId:$scope.bookRank[index].bookid
            },
            success:function (data, status) {
                //console.log(data.content);
                localStorage.setItem("books1", JSON.stringify( data.content));
                //console.log(localStorage.setItem("books1", JSON.stringify( data.content)));
                localStorage.setItem("tabs", 0);
                $state.go('bookInfo');
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }


    $scope.logout = function () {
        $ionicLoading.show({
            template: '<ion-spinner icon="ios-small"></ion-spinner>',
            content: 'Loading',
            animation: 'fade-in',
            showBackdrop: true,
            maxWidth: 200,
            showDelay: 0
        });

        $timeout(function () {
            $ionicLoading.hide();
            $ionicPopup.alert({
                title:'提示',
                template:'退出成功！'
            });
            $state.go('login');
        }, 2000);

    }

    //去个人中心
    $scope.goPersonalCenter = function () {
        $state.go('personalCenter');
    }

    //去我的订单
    $scope.goMyOrder = function () {
        $state.go('order');
    }

    //去我的动态
    $scope.goMyFriend = function () {
        $state.go('myFriend');
    }

    //去关于我们
    $scope.goAboutUs = function () {
        $state.go('aboutUs');
    }

    //去我的通知
    $scope.goMyNotice = function () {
        localStorage.setItem("tab", 0);
        $state.go('myNotice');
    }

    //去上传二手书
    $scope.goUploadBook = function () {
        $state.go('uploadBook');
    }

    //获取条数
    getCount();

  function getCount() {
      $.ajax({
          url:apiRoot+'index/count',
          type:'post',
          data:{
              userid:$scope.users.userid
          },
          success:function (data, status) {
              // data = JSON.parse(data);
              $scope.counts = data.content;
              //console.log(data.content)
          },

          fail:function (err, status) {
              console.log(err)
          }
      })
  }
})