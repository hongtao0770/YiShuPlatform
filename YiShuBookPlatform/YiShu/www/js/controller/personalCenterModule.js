angular.module('personalCenterModule',[])
    .controller('personalCenterCtrl',function($scope,$state,$cordovaDialogs,$ionicLoading,$ionicPopup){

        //返回按钮
        $scope.goBack = function () {
            $state.go('list.homePage');
        }

        //去修改密码
        $scope.goFgInfo = function () {
            $state.go('forgetInfo');
        }

        //去修改头像
        $scope.goUpHead = function () {
            $state.go('uploadhead');
        }

        $scope.user = JSON.parse(localStorage.getItem("user"));

        //获取用户最新信息
        getuserInfo()

        function getuserInfo() {
            $.ajax({
                url: apiRoot+'user/getUserById' ,
                type: 'POST',
                data:{
                    userid: $scope.user.userid
                },
                dataType:'json',
                success:function (data, status) {
                    //console.log(data.content);
                    $scope.users = data.content;
                    $scope.$apply();
                },

                fail:function (err, status) {
                    console.log(err)
                }
            });
        }

         //console.log($scope.users.userid);
        //修改个人资料
        $scope.save = function () {
            var nickname = $('#nickname').val();
            var address = $('#address').val();
            $.ajax({
                url:apiRoot+'user/saveInfo',
                type:'post',
                data:{
                  userid:$scope.users.userid,
                  nickname:nickname,
                  address:address
                },
                success:function (data, status) {
                    //console.log(data.content);
                    var confirmPopup = $ionicPopup.confirm({
                        title: '提示',
                        template: '保存成功！'
                    });
                    confirmPopup.then(function(res) {
                        if(res) {
                            localStorage.setItem("user", JSON.stringify(data.content));
                            $state.go("list.homePage");
                        }
                    });
                    // $cordovaDialogs.confirm('保存成功','提示',['OK'])
                    //     .then(function(buttonIndex){
                    //         var btnIndex = buttonIndex;
                    //         switch(buttonIndex){
                    //             case 1:
                    //                 localStorage.setItem("user", JSON.stringify(data.content));
                    //                 $state.go("list.homePage");
                    //                 break;
                    //             case 2:
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