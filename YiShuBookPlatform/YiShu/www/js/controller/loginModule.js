
var GlobalUserId  =0;

angular.module('loginModule',[])
    .controller('loginCtrl',function($scope,$state
        , $cordovaDialogs, $ionicPopup, $ionicLoading,$timeout,$cordovaDialogs){
        //查看密码
        $scope.showPwd = function(){
            var typeStyle = $("#LoginPasswordId").attr("type");
            //console.log(typeStyle);
            if(typeStyle == "password"){
                $("#LoginPasswordId").attr("type","text");
            }else
            {
                $("#LoginPasswordId").attr("type","password");
            }
        }
        //去注册
        $scope.goRegisterBtn = function()
        {
            $state.go('register');
        }

        //忘记密码
        $scope.goForgetInfoBtn = function () {
            $state.go('forgetInfo');
        }

        //登录
        $scope.loginBtn = function () {
            var phone = $scope.userPhone ;
            var pwd = $scope.userPassword;

            if(!phone || phone == ''){
                $ionicPopup.alert({
                    title:'错误',
                    template:'请输入手机号'
                });
                return;
            }

            if(!pwd || pwd == ''){
                $ionicPopup.alert({
                    title:'错误',
                    template:'请输入密码'
                });
                return;
            }


            doLogin(phone, pwd);
        }

        function doLogin(phone, pwd){

            $.ajax({
                url: apiRoot+'login/checklogin',
                type:'post',
                data:{
                    phone:phone,
                    pwd:pwd
                },
                success:function (data, status) {
                    $ionicLoading.hide();
                    //console.log(data)
                    if(data.code<0){
                        // $cordovaDialogs.alert(data.message,"提示","确认")
                        //     .then(function(){});
                        $ionicPopup.alert({
                            title:'提示',
                            template:data.message
                        });
                        return;
                    }

                        var confirmPopup = $ionicPopup.confirm({
                            title: '提示',
                            template: '登录成功！'
                        });
                        confirmPopup.then(function(res) {
                            if(res) {
                                $ionicLoading.show({
                                    template: '<ion-spinner icon="ios-small"></ion-spinner>',
                                    content: 'Loading',
                                    animation: 'fade-in',
                                    showBackdrop: true,
                                    maxWidth: 200,
                                    showDelay: 0
                                });

                                $timeout(function () {
                                    localStorage.setItem("user", JSON.stringify(data.content));
                                    $ionicLoading.hide();
                                    $state.go('list.homePage');
                                }, 2000)

                            }
                        });

                    // $cordovaDialogs.confirm("登录成功！","提示",['OK'])
                    //     .then(function(buttonIndex){
                    //         var btnIndex = buttonIndex;
                    //         switch(btnIndex){
                    //             case 1:
                    //                 console.log('进入易书图书平台首页');
                    //                 console.log(data.content);
                    //                 localStorage.setItem("user", JSON.stringify(data.content));
                    //                 $state.go('list.homePage');
                    //                 break;
                    //         }
                    //     });
                },
                fail:function (err, status) {
                    console.log(err)
                }


            })
        }
})