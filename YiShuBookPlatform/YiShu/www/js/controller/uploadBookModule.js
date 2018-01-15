angular.module('uploadBookModule',[])
    .controller('uploadBookCtrl',function($scope,$state,$ionicHistory,$cordovaDialogs,$ionicPopup){
        $scope.goBack = function () {
            $state.go('list.homePage');
        }

        $scope.users = JSON.parse(localStorage.getItem("user"));
        //console.log($scope.users);

        //提交
        $scope.tijiao = function () {
            var data = new FormData($('#form2')[0]);
            var bookname  = $('#bookname').val();
            var bookprice  = $('#bookprice').val();
            var bookcontent  = $('#bookcontent').val();
            var booktype  = $('#booktype').val();
            if(bookname == "" || bookprice=="" || bookcontent =="" || booktype=="")
            {
                $ionicPopup.alert({
                    title: '上传信息',
                    template:'请完善信息！'
                });
            }else
            {
                $.ajax({
                    url: apiRoot+'user/uploadbook' ,
                    type: 'POST',
                    data:data,
                    dataType:'json',
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (data, status) {
                        //console.log(data.content);
                        $ionicPopup.alert({
                            title: '上传信息',
                            template: data.message
                        });
                        $("button[type='reset']").trigger("click");//触发reset按钮

                        //通过form表单的dom对象的reset方法来清空
                        $('form')[0].reset();
                        // $cordovaDialogs.alert("上传成功!","提示","确认")
                        //     .then(function(){
                        //         $("button[type='reset']").trigger("click");//触发reset按钮
                        //
                        //         //通过form表单的dom对象的reset方法来清空
                        //         $('form')[0].reset();
                        //     });
                    },

                    fail:function (err, status) {
                        console.log(err)
                    }
                });
            }

        }

        //去上传记录
        $scope.goRecord = function () {
            $state.go('uploadRecord');
        }
})