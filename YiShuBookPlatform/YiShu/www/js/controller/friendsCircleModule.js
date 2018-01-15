angular.module('friendsCircleModule',[])
    .controller('friendsCircleCtrl',function($scope,$state,$timeout,$ionicLoading,$ionicPopup){


        $scope.users = JSON.parse(localStorage.getItem("user"));

        console.log("当前登录用户："+$scope.users.userid);


        //下拉刷新
        $scope.doRefresh = function() {
            console.log('刷新书友圈');
            getFriend();
            $scope.$broadcast("scroll.refreshComplete");
        };


        //发表动态
        $scope.publish = function () {
        var content =$("#content").val();
        if(content == "")
        {
            $ionicPopup.alert({
                title:'提示',
                template:'动态不能为空！'
            });
        }else
        {
            //console.log(content);
            $.ajax({
                url:apiRoot+'friendCircle/addDynamic',
                type:'post',
                data:{
                    userid:$scope.users.userid,
                    content:content
                },
                success:function (data, status) {
                    console.log(data);
                    if(data.code>0)
                    {
                        $ionicLoading.show({
                            template: '<ion-spinner icon="ios-small"></ion-spinner>',
                            content: 'Loading',
                            animation: 'fade-in',
                            showBackdrop: true,
                            maxWidth: 200,
                            showDelay: 0
                        });
                    }

                    $timeout(function () {
                        $ionicLoading.hide();
                        $("#content").val("").focus();
                        getFriend();
                        $ionicPopup.alert({
                            title:'提示',
                            template:data.message
                        });
                    }, 2000);
                },

                fail:function (err, status) {
                    console.log(err)
                }
            })
        }
    }

    //获取动态
    getFriend();


    function getFriend() {
        $.ajax({
            url:apiRoot+'friendCircle/getDynamic',
            type:'post',
            success:function (data, status) {
                //console.log(data);
                $scope.allFriends = data.content;
                $scope.$apply();
            },
            fail:function (err, status) {
                console.log(err)
            }
        })
    }


     //发表评论
     $scope.send = function (index) {
         var common = $("#" + index).val();
         console.log(common);
         if(common == "")
         {
             $ionicPopup.alert({
                 title:'提示',
                 template:'评论不能为空！'
             });
         }else
         {
             var fid = $scope.allFriends[index].id;
             //console.log(friend);
             addCommon(common,fid);
         }
     }

     //添加评论
     function addCommon(common,fid) {
         $.ajax({
             url:apiRoot+'friendCircle/addCommon',
             type:'post',
             data:{
                 common: common,
                 fid:fid,
                 userid:$scope.users.userid
             },
             success:function (data, status) {
                 console.log(data);
                 if(data.code>0)
                 {
                     $ionicLoading.show({
                         template: '<ion-spinner icon="ios-small"></ion-spinner>',
                         content: 'Loading',
                         animation: 'fade-in',
                         showBackdrop: true,
                         maxWidth: 200,
                         showDelay: 0
                     });
                 }

                 $timeout(function () {
                     $ionicLoading.hide();
                     $("#common").val("").focus();
                     getFriend();
                     $ionicPopup.alert({
                         title:'提示',
                         template:data.message
                     });
                 }, 2000);
             },

             fail:function (err, status) {
                 console.log(err);
             }
         })
     }

     //点赞
    $scope.giveZan = function (index) {
        console.log($scope.allFriends[index].id);
        var id = $scope.allFriends[index].id;
        addFabulous(id)
    }

    function addFabulous(id) {
        $.ajax({
            url:apiRoot+'friendCircle/addFabulous',
            type:'post',
            data:{
              id:id
            },
            success:function (data, status) {
                console.log(data);
                if(data.code>0)
                {
                    $ionicLoading.show({
                        template: '<ion-spinner icon="ios-small"></ion-spinner>',
                        content: 'Loading',
                        animation: 'fade-in',
                        showBackdrop: true,
                        maxWidth: 200,
                        showDelay: 0
                    });
                }

                $timeout(function () {
                    $ionicLoading.hide();
                    var imgSrc = $("#dianzan").children().attr("src");
                    if(imgSrc == "img/dianzai2.png")
                    {
                        $("#dianzan").children().attr("src","img/dianzan.png");
                    }else
                    {
                        $("#dianzan").children().attr("src","img/dianzan2.png");
                    }
                    $scope.$apply();
                    getFriend();
                    $ionicPopup.alert({
                        title:'提示',
                        template:data.message
                    });
                }, 2000);
            },
            fail:function (err, status) {
                console.log(err)
            }
        })
    }


        //去我的通知
        $scope.goMyNotice = function () {
            localStorage.setItem("tab", 2);
            $state.go('myNotice');
        }


})