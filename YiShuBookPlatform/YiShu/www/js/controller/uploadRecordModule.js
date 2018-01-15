angular.module('uploadRecordModule',[])
    .controller('uploadRecordCtrl',function($scope,$state,$ionicHistory,$ionicLoading,$timeout,$ionicPopup){

        //返回按钮
        $scope.goBack = function () {
            $ionicHistory.goBack();
        }

        $scope.users = JSON.parse(localStorage.getItem("user"));

        getRecord();

        function getRecord() {
            $.ajax({
                url: apiRoot+'user/uploadRecord' ,
                type: 'POST',
                data:{
                    userid: $scope.users.userid
                },
                dataType:'json',
                success:function (data, status) {
                    console.log(data.content);
                    $scope.records = data.content;
                },

                fail:function (err, status) {
                    console.log(err)
                }
            });
        }


})