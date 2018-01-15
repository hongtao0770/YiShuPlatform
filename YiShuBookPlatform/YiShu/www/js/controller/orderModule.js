angular.module('orderModule',[])
    .controller('orderCtrl',function($scope,$state){

        //返回主界面
        $scope.goBack= function () {
            $state.go('list.homePage');
        }

        //判断选取选项卡
        $scope.selectTabsWithIndex = function (index) {
            doJudgeArrayByIndex(index);
        }

        //判断选项卡
        function doJudgeArrayByIndex(index)
        {
            switch(index){
                case 0:
                    getOrderInfo();
                    break;
                case 1:
                    getOrderInfo2()
                    break;

            }
        }

        //下拉刷新
        $scope.doRefresh = function(index)
        {
            doJudgeArrayByIndex(index);
            console.log('刷新数据');
            $scope.$broadcast("scroll.refreshComplete")
        }

        //获取当前登录用户信息
        var users = JSON.parse(localStorage.getItem("user"));
        //console.log(users.userid);



        function getOrderInfo() {
            $.ajax({
                url:apiRoot+'order/getOrderInfo',
                type:'post',
                data:{
                    userid:users.userid,
                    orderstate:0
                },
                success:function (data, status) {
                    //console.log(data.content);
                    $scope.orders = data.content;
                    $scope.$apply();
                },

                fail:function (err, status) {
                    console.log(err)
                }
            })
        }

        function getOrderInfo2() {
            $.ajax({
                url:apiRoot+'order/getOrderInfo',
                type:'post',
                data:{
                    userid:users.userid,
                    orderstate:1
                },
                success:function (data, status) {
                    //console.log(data.content);
                    $scope.orders2 = data.content;
                    $scope.$apply();
                },

                fail:function (err, status) {
                    console.log(err)
                }
            })
        }
})