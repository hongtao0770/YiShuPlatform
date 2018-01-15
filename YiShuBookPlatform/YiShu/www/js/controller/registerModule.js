angular.module('registerModule',[])
    .controller('registerCtrl',function($scope,$state,$ionicHistory,$ionicPopup,$ionicLoading){
        //返回按钮
        $scope.loginBack = function()
        {
            $ionicHistory.goBack();
        }
        //显示密码
        $scope.showPwd = function()
        {
            var typeStyle = $("#RegPasswordId").attr("type");
            //console.log(typeStyle);
            if(typeStyle == "password"){
                $("#RegPasswordId").attr("type","text");
            }else
            {
                $("#RegPasswordId").attr("type","password");
            }
        }
        //清空输入内容
        $scope.dismissOne = function()
        {
            $scope.userRegVerify =null;
        }

        $scope.dismissTwo = function()
        {
            $scope.userRegNickName =null;
        }

        $scope.dismissThree = function()
        {
            $scope.userRegPassword =null;
        }
        //勾选
        $scope.docheck = function()
        {
            var imgSrc = $("#readState").children().attr("src");
            if(imgSrc == "img/uncheck.png")
            {
                $("#readState").children().attr("src","img/check.png");
            }else
            {
                $("#readState").children().attr("src","img/uncheck.png");
            }
        }



        //获取短信验证码
        $scope.getVerifyCode = function () {
             var phone = $scope.userRegPhone;
             var verifyCode = $scope.userRegVerify;
            if(phone!= undefined){
                console.log(phone);
                Bmob.initialize("da54955f45f50baf118d0ad35227bd75", "8ff9d4461255e635a3704f08e6619a1a");
                Bmob.Sms.requestSmsCode({"mobilePhoneNumber": phone, "template":"【易书图书平台】"} ).then(function(obj) {
                    console.log("smsId:"+obj.smsId); //
                    var count = 60;
                    var countdown = setInterval(CountDown, 1000);

                    function CountDown() {
                        $(".verify").attr("disabled", true);
                        $(".verify").text( count+"秒后重发");
                        if (count == 0) {
                            $(".verify").text("获取验证码").removeAttr("disabled");
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

        //注册
        $scope.registerBtn = function () {
             var phone = $scope.userRegPhone;
             var verifyCode = $scope.userRegVerify;
            Bmob.initialize("da54955f45f50baf118d0ad35227bd75", "8ff9d4461255e635a3704f08e6619a1a");
            Bmob.Sms.verifySmsCode(phone, verifyCode).then(function(obj) {
                console.log("msg:"+obj.msg); //
                    var nickname =$scope.userRegNickName;
                    var pwd = $scope.userRegPassword;
                    console.log(pwd.length);
                    var imgSrc = $("#readState").children().attr("src");
                    if(imgSrc == "img/uncheck.png")
                    {
                        $ionicPopup.alert({
                            title: '提示',
                            template:'未阅读服务条款！'
                        });
                    }else if(pwd.length<6 || pwd.length>12)
                    {
                        $ionicPopup.alert({
                            title: '提示',
                            template:'密码不符合规范！'
                        });
                    }
                    else{
                    register(phone,nickname,pwd);
                }

            }, function(err){
                $ionicPopup.alert({
                    title: '验证码',
                    template:'验证码错误！'
                });
            });
        }



        function register(phone,nickname,pwd) {
            $.ajax({
                url:apiRoot+'register/register',
                type:'post',
                data:{
                    phone:phone,
                    nickname:nickname,
                    password:pwd
                },
                success:function (data, status) {
                    //$ionicLoading.hide();
                    console.log(data);
                    if (data.code > 0) {
                        $ionicPopup.alert({
                            title: '注册信息',
                            template: data.message
                        });
                        $state.go('login');
                        return;
                    }else
                    {
                        $ionicPopup.alert({
                            title: '注册信息',
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