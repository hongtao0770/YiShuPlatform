angular.module('activityModule',[]).controller('activityCtrl',function($scope,$state){

    $scope.doRefresh = function() {
        console.log('刷新活动的数据');
        getActivities();
        $scope.$broadcast("scroll.refreshComplete");
    };

    getActivities();

    function getActivities() {
        $.ajax({
            url:apiRoot+'activity/getActivities',
            type:'get',
            success:function (data, status) {
                //console.log(data.content);
                $scope.activities = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    //去我的通知
    $scope.goMyNotice = function () {
        localStorage.setItem("tab", 3);
        $state.go('myNotice');
    }

    $scope.goActivityInfo = function (index) {
        localStorage.setItem("activity", JSON.stringify($scope.activities[index]));
        $state.go('activityInfo');
    }
})