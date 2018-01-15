angular.module('uploadheadModule',[])
    .controller('uploadheadCtrl',function($scope,$state,$ionicHistory,$cordovaDialogs,$ionicPopup){
        //返回按钮
        $scope.goBack = function () {
            $ionicHistory.goBack();
        }

        //获取当前用户登录信息
        $scope.users = JSON.parse(localStorage.getItem("user"));


        //提交
        $scope.tijiao = function () {
            var data = new FormData($('#form1')[0]);
            var id = $('#1').val();
            if(id == "")
            {
                $ionicPopup.alert({
                    title: '提示',
                    template: '请选择一张图片！'
                });
            }else
            {
                $.ajax({
                    url: apiRoot+'user/upload' ,
                    type: 'POST',
                    data:data,
                    dataType:'json',
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (data, status) {
                        // $cordovaDialogs.alert("修改头像成功!","提示","确认")
                        //     .then(function(){
                        //         localStorage.setItem("user", JSON.stringify(data.content));
                        //         $state.go("list.homePage");
                        //     });
                        $ionicPopup.alert({
                            title: '提示',
                            template: data.message
                        });
                        localStorage.setItem("user", JSON.stringify(data.content));
                        $state.go("list.homePage");
                    },
                    fail:function (err, status) {
                        console.log(err)
                    }
                });
            }

        }
})