angular.module('bookStoreModule',[]).controller('bookStoreCtrl',function($scope,$state){

    //修改图片初始位置
    $scope.activeSlide = 0;

    //判断选取选项卡
    $scope.selectTabsWithIndex = function (index) {
        doJudgeArrayByIndex(index);
    }

    //下拉刷新
    $scope.doRefresh = function(index)
    {
        doJudgeArrayByIndex(index);
        console.log('刷新数据');
        $scope.$broadcast("scroll.refreshComplete")
    }

    //判断选项卡
    function doJudgeArrayByIndex(index)
    {
        switch(index){
            case 0:
                getTodayPriceBook();
                getNewBooks();
                break;
            case 1:
                getOldBooks()
                break;

        }
    }


    //获取今日特价书
    function getTodayPriceBook() {
        var bookSale = 1;
        $.ajax({
            url:apiRoot+'book/getBooksOnSale',
            type:'post',
            data:{
                bookSale:bookSale
            },
            success:function (data, status) {
                //console.log(data.content);
                $scope.books1 = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    //获取最新上架图书
    function getNewBooks() {
        $.ajax({
            url:apiRoot+'book/getAllBooks',
            type:'get',
            success:function (data, status) {
                //console.log(data.content);
                $scope.allBooks = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }


    $scope.goBookInfoWithId1 = function(index)
    {
        //console.log(index);

        localStorage.setItem("books1", JSON.stringify( $scope.books1[index]));
        localStorage.setItem("tabs", 1);
        $state.go('bookInfo');

    }

    $scope.goBookInfoWithId2 = function(index)
    {
        //console.log(index);

        localStorage.setItem("books1", JSON.stringify($scope.allBooks[index]));
        localStorage.setItem("tabs", 1);
        $state.go('bookInfo');

    }

    $scope.goBookInfoWithId3 = function(index)
    {
        //console.log(index);

        localStorage.setItem("books2", JSON.stringify($scope.oldBooks[index]));

        $state.go('bookInfo2');

    }

    //获取二手书信息
    function getOldBooks() {
        $.ajax({
            url:apiRoot+'book/getOldBooks',
            type:'get',

            success:function (data, status) {
                console.log(data.content);
                $scope.oldBooks = data.content;
                $scope.$apply();
            },

            fail:function (err, status) {
                console.log(err)
            }
        })
    }

    //去我的通知
    $scope.goMyNotice = function () {
        localStorage.setItem("tab", 1);
        $state.go('myNotice');
    }

})