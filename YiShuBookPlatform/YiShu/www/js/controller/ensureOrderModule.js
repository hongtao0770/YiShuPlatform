angular.module('ensureOrderModule',[])
    .controller('ensureOrderCtrl',function($scope,$state,$cordovaDialogs,$ionicPopup,$ionicLoading,$ionicHistory){


    $scope.books = JSON.parse(localStorage.getItem("books1"));
    // console.log($scope.users.address);

    $scope.users = JSON.parse(localStorage.getItem("user"));
    //console.log($scope.books.bookprice);
    //console.log($scope.users.money);
    //添加订单
    $scope.ensureOrder = function () {
        if($scope.users.address == null)
        {
            $ionicPopup.alert({
                title:'提示',
                template:'未填写地址，请完善个人信息'
            });
        }
        else if(parseFloat($scope.users.money) < parseFloat($scope.books.bookprice))
        {
            $ionicPopup.alert({
                title:'提示',
                template:'余额不足，请先充值！'
            });
        }
        else
        {
            var confirmPopup = $ionicPopup.confirm({
                title: '提示',
                template: '是否确认购买？'
            });
            confirmPopup.then(function(res) {
                if(res) {
                    addOrder();
                }
            });
            // $cordovaDialogs.confirm('是否确认购买','提示',['是','否'])
            //     .then(function(buttonIndex){
            //         var btnIndex = buttonIndex;
            //         switch(buttonIndex){
            //             case 1:
            //                 addOrder();
            //                 break;
            //             case 2:
            //                 break;
            //         }
            //     });
        }

    }
    
    //返回
        $scope.goBack = function () {
            var confirmPopup = $ionicPopup.confirm({
                title: '提示',
                template: '是否取消购买？'
            });
            confirmPopup.then(function(res) {
                if(res) {
                    $ionicHistory.goBack();
                }
            });
            // $cordovaDialogs.confirm('是否取消购买','提示',['是','否'])
            //     .then(function(buttonIndex){
            //         var btnIndex = buttonIndex;
            //         switch(buttonIndex){
            //             case 1:
            //                 $ionicHistory.goBack();
            //                 break;
            //             case 2:
            //                 break;
            //         }
            //     });
        }

    function addOrder() {
        $.ajax({
            url:apiRoot+'/order/addOrder',
            type:'post',
            data:{
                bookId:$scope.books.bookid,
                bookName: $scope.books.bookname,
                orderPrice:$scope.books.bookprice,
                userId:$scope.users.userid,
                orderAdress:$scope.users.address,
                orderPic:$scope.books.bookposter
            },
            success:function (data, status) {
                //console.log(data);
                var confirmPopup = $ionicPopup.confirm({
                    title: '提示',
                    template: '购买成功！'
                });
                confirmPopup.then(function(res) {
                    if(res) {
                        localStorage.setItem("user", JSON.stringify(data.content));
                        $state.go("list.homePage");
                    }
                });
                // $cordovaDialogs.confirm('购买成功','提示',['OK'])
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
                console.log(err);
            }
        })
    }
})