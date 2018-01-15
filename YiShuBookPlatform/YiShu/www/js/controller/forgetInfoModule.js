angular.module('forgetInfoModule',[])
    .controller('forgetInfoCtrl',function($scope,$state,$ionicHistory,$ionicPopup,$ionicLoading,$timeout){
    //返回按钮
    $scope.loginBack = function()
    {
        $ionicHistory.goBack();
    }

    //显示密码
    $scope.showPwd = function()
    {
        var typeStyle = $("#NewPassword").attr("type");
        //console.log(typeStyle);
        if(typeStyle == "password"){
            $("#NewPassword").attr("type","text");
        }else
        {
            $("#NewPassword").attr("type","password");
        }
    }

    //清空输入内容

    $scope.dismissThree = function()
    {
        $scope.userNewPassword =null;
    }

    //获取短信验证码
    $scope.getVerifyCode = function () {
        var phone = $scope.userPhone;
        var verifyCode = $scope.userVerify;
        if(phone!= undefined){
            console.log(phone);
            Bmob.initialize("da54955f45f50baf118d0ad35227bd75", "8ff9d4461255e635a3704f08e6619a1a");
            Bmob.Sms.requestSmsCode({"mobilePhoneNumber": phone, "template":"【易书图书平台】"} ).then(function(obj) {
                console.log("smsId:"+obj.smsId); //
                var count = 60;
                var countdown = setInterval(CountDown, 1000);

                function CountDown() {
                    $(".verify1").attr("disabled", true);
                    $(".verify1").text( count+"秒后重发");
                    if (count == 0) {
                        $(".verify1").text("获取验证码").removeAttr("disabled");
                        clearInterval(countdown);
                    }
                    count--;
                }
            }, function(err){
                console.log("发送失败:"+err);
            });
        }else{
            $ionicPopup.alert({
                title: '提示',
                template:'请输入手机号'
            });
        }
    }


        //修改密码
        $scope.editBtn = function () {
            var phone = $scope.userPhone;
            var verifyCode = $scope.userVerify;
            Bmob.initialize("da54955f45f50baf118d0ad35227bd75", "8ff9d4461255e635a3704f08e6619a1a");
            Bmob.Sms.verifySmsCode(phone, verifyCode).then(function(obj) {
                console.log("msg:"+obj.msg); //
                var pwd = $scope.userNewPassword;
                edit(phone,pwd);

            }, function(err){
                $ionicPopup.alert({
                    title: '验证码',
                    template:'验证码错误！'
                });
            });
        }

        function edit(phone,pwd) {
            $.ajax({
                url:apiRoot+'user/editMima',
                type:'post',
                data:{
                    phone:phone,
                    password:pwd
                },
                success:function (data, status) {
                    //$ionicLoading.hide();
                    console.log(data);
                    if (data.code > 0) {
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
                            $("#content").val("").focus();
                            $ionicPopup.alert({
                                title: '修改信息',
                                template: data.message
                            });
                            $state.go('login');
                        }, 2000);
                        return;
                    }else
                    {
                        $ionicPopup.alert({
                            title: '修改信息',
                            template: data.message
                        });
                        return;
                    }

                },
                fail:function (err, status) {
                    console.log(err)
                }
            })
        }
})