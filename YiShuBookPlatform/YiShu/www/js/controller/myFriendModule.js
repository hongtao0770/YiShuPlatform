angular.module('myFriendModule',[])
    .controller('myFriendCtrl',function($scope,$state,$ionicLoading,$timeout){

        //返回主界面
        $scope.goBack = function () {
            $state.go('list.homePage');
        }

        //获取当前登录用户信息
        $scope.users = JSON.parse(localStorage.getItem("user"));
        //console.log($scope.users.userid);

        //下拉刷新
        $scope.doRefresh = function() {
            console.log('刷新我的动态数据');
            $scope.$broadcast("scroll.refreshComplete");
        };
        
        getFriends();
        
        function getFriends() {
            $.ajax({
                url:apiRoot+'friendCircle/getFriends',
                type:'post',
                data:{
                    userid:$scope.users.userid
                },
                success:function (data, status) {
                    //console.log(data.content);
                    $scope.friends = data.content;
                    $scope.$apply();
                },

                fail:function (err, status) {
                    console.log(err)
                }
            })
        }

        $scope.delete = function (index) {
            console.log($scope.friends[index].id);
            $.ajax({
                url:apiRoot+'friendCircle/delete',
                type:'post',
                data:{
                    id:$scope.friends[index].id
                },
                success:function (data, status) {
                    //console.log(data.content);
                    $ionicLoading.show({
                        template: '<ion-spinner icon="ios-small"></ion-spinner>',
                        content: 'Loading',
                        animation: 'fade-in',
                        showBackdrop: true,
                        maxWidth: 200,
                        showDelay: 0
                    });

                    $timeout(function () {
                        getFriends();
                        $ionicLoading.hide();
                    }, 2000);
                },

                fail:function (err, status) {
                    console.log(err)
                }
            })
        }
})