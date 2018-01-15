angular.module('myNoticeModule',[])
    .controller('myNoticeCtrl',function($scope,$state,$ionicLoading,$timeout,$ionicPopup,$ionicModal){

        //下拉刷新
        $scope.doRefresh = function() {
            console.log('刷新首页数据');
            getNoticeById();
            $scope.$broadcast("scroll.refreshComplete");
        };

        $ionicModal.fromTemplateUrl('templates/modal.html', {
            scope: $scope
        }).then(function(modal) {
            $scope.modal = modal;
        });

    //返回
    $scope.goBack = function()
    {
        if(localStorage.getItem("tab") == 0)
        {
            $state.go('list.homePage');
        }else if(localStorage.getItem("tab") ==1 )
        {
            $state.go('list.bookStore');
        }else if(localStorage.getItem("tab") ==2 )
        {
            $state.go('list.friendsCircle');
        }else if(localStorage.getItem("tab") ==3 )
        {
            $state.go('list.activity');
        }else
        {
            $state.go('list.homePage');
        }

    }

    //获取当前登录用户信息
    $scope.users = JSON.parse(localStorage.getItem("user"));


    //获取通知
    getNoticeById();


    function getNoticeById() {
        $.ajax({
            url:apiRoot+'user/getNoticeById',
            type:'post',
            data:{
                userid:$scope.users.userid
            },
            success:function (data, status) {
                console.log(data.content);
                $scope.notices = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    $scope.delete = function (index) {
        console.log(index);
        //console.log($scope.notices[index].noticeid);
        $.ajax({
            url:apiRoot+'user/deleteNotice',
            type:'post',
            data:{
                noticeid:$scope.notices[index].noticeid
            },
            success:function (data, status) {
                console.log(data.content);
                $ionicLoading.show({
                    template: '<ion-spinner icon="ios-small"></ion-spinner>',
                    content: 'Loading',
                    animation: 'fade-in',
                    showBackdrop: true,
                    maxWidth: 200,
                    showDelay: 0
                });

                $timeout(function () {
                    getNoticeById();
                    $ionicPopup.alert({
                        title:'提示',
                        template:'删除成功！'
                    });
                    $ionicLoading.hide();
                }, 2000);
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

        $scope.sendMessage = function () {
            var messagecontent = $("#messagecontent").val();
            var phone = $("#phone").val();
            if(messagecontent == "" && phone =="")
            {
                $ionicPopup.alert({
                    title:'提示',
                    template:'信息不能为空！'
                });
            }else
            {
                $.ajax({
                    url:apiRoot+'user/sendMessage',
                    type:'post',
                    data:{
                        userid:$scope.users.userid,
                        messagecontent:messagecontent,
                        phone:phone
                    },
                    success:function (data, status) {
                        //console.log(data.content);
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
                            $("#messagecontent").val("").focus();
                            $("#phone").val("").focus();
                            $ionicPopup.alert({
                                title:'提示',
                                template:data.message
                            });
                        }, 2000);
                    },

                    fail:function (err, status) {
                        //console.log(err)
                        $ionicPopup.alert({
                            title:'提示',
                            template:data.message
                        });
                    }
                })
            }

        }

})