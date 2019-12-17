$(function () {
    getAllPrice();
    getAllNum();

    getCALLPrice();
    getCAllNum();
});

/**
 * 计算上层购物车中的总价格
 */
function getAllPrice() {
    var siPicice = $('.siPicice');
    var allPrice = 0;
    $(siPicice).each(function (k,v) {
        allPrice += parseInt($(v).html());
    })
    $('#allPrice').html(allPrice);
}

/**
 * 计算上层购物车中的总个数
 */
function getAllNum() {
    var si_num = $('.si_num');
    var all_num = 0;
    $(si_num).each(function (k,v) {
        all_num += parseInt($(v).val());
    });
    $('#all_num').html(all_num);
}

/**
 * 页面的搜索
 */
function a_search(url) {
    var inp_val = $(".search-field").val();

    //如果用户没有填写搜索内容，不让跳转
    if(inp_val == '' || inp_val == null || inp_val == undefined){
        $(".search-field").attr('placeholder','请填写搜索内容');
        return false;
    }

    window.location.href = url + "?search=" + inp_val;
};

//点击购物车的删除按钮
function del(a,url) {
    var goods_id = $(a).attr('goods_id');
    if(confirm('是否删除此物品')){
        $.ajax({
            type:'post',
            url:url,
            data:{'goods_id':goods_id},
            dateType:'json',
            success:function (res) {
                var _res = JSON.parse(res);
                if(_res.status == 1){
                    //删除下面的购物车的对应数据
                    var downClose = $('a[name=downClose]');
                    $(downClose).each(function (k,v) {
                        if($(v).attr('goods_id') == goods_id){
                            $(v).parent().parent().remove();
                        }
                    })

                    //删除上面的购物车对应的数据
                    var upclose = $('a[name=upclose]');
                    $(upclose).each(function (k,v) {
                        if($(v).attr('goods_id') == goods_id){
                            $(v).parent().parent().remove();
                        }
                    })

                    //当删除成功后调用购物车的金额、数量计算方法
                    getAllNum();
                    getAllPrice();

                    //当删除成功后调用计算下方购物车金额、数量的方法
                    getCALLPrice();
                    getCAllNum();
                    //在ajax中不能通过$(this)调用ajax外面的标签对象
//                            $(this).parent().parent().remove();
                }else{
                    alert(_res.msg);
                }
            }
        });
    }
}

/**
 * 计算下方购物车中的总价格
 */
function getCALLPrice() {
    var c_si_price = $(".c_si_price");
    var c_all_price = 0;
    $(c_si_price).each(function (k,v) {
        c_all_price += parseInt($(v).html());
    });
    $('#c_all_price').html(c_all_price);
}

/**
 * 计算下方购物车中的总个数
 */
function getCAllNum() {
    var c_si_num = $("input[name=quantity]");
    var c_all_num = 0;
    $(c_si_num).each(function (k,v) {
        c_all_num += parseInt($(v).val());
    });
    $('.c_all_num').html(c_all_num);
}

//点击增加购物数量
function add_goods(a,url) {
    // var a = 0.37;
    // var b = 0.95;
    // var c = a + b;
    // console.log(c);
    //上面的结果会出现1.3199999999999998 ,js中浮点数不能直接加减  需要toFixed(2)转换

    var goods_id = $(a).attr('goods_id');
    var val = parseInt($(a).siblings('input').val());
    var temp_val = val + 1;

    //ajax更改数据库信息
    $.ajax({
        type:'post',
        url:url,
        data:{'goods_id':goods_id,'num':temp_val},
        dataType:'json',
        success:function (res) {
            // var _res = JSON.parse(res);
            if(res.status == 2){
                alert(res.msg);
            }else{
                //获取a标签的所有同级input对象的值
                $(a).siblings('input').val(temp_val);

                //更改上方的购物车总数量
                var a_price = $('.si_num');
                $(a_price).each(function (k,v) {
                    //只有当金额中的goods_id和点击的对用的goods_id相等的时候才更新
                    if($(v).attr('goods_id') == goods_id){
                        $(v).val(temp_val);
                    }
                })

                //更改上方购物车每件商品对应的数量
                var d_si_num = $('.d_si_num');
                $(d_si_num).each(function (k,v) {
                    //只有当金额中的goods_id和点击的对用的goods_id相等的时候才更新
                    if($(v).attr('goods_id') == goods_id){
                        $(v).html(temp_val);
                    }
                })


                //更改对应的金额 (总金额/个数)*改变后的个数=新的总金额
                var n_p = (parseFloat($('.c_si_price').html()).toFixed(2)/val)*temp_val;
                var newPrice = Math.round(n_p,2);

                //获取所有下方的金额对象
                var c_si_price = $('.c_si_price');
                //循环判断下方的goods_id相同的金额进行更改
                $(c_si_price).each(function (k,v) {
                    if($(v).attr('goods_id') == goods_id){
                        $(v).html(newPrice);
                    }
                })
                //获取所有上方的金额对象
                var siPicice = $('.siPicice');
                //循环判断上方的goods_id相同的金额进行更改
                $(siPicice).each(function (k,v) {
                    //只有当金额中的goods_id和点击的对用的goods_id相等的时候才更新
                    if($(v).attr('goods_id') == goods_id){
                        $(this).html(newPrice);
                    }
                })

                getAllPrice();
                getAllNum();

                getCALLPrice();
                getCAllNum();
            }
        }
    });

}

//点击减少购物数量

function reduce_goods(a,url) {
    var goods_id = $(a).attr('goods_id');
    var val = parseInt($(a).siblings('input').val());
    var temp_val = val - 1;
    if(temp_val < 1){
        temp_val = 1;
    }
    $(a).siblings('input').val(temp_val);

    //ajax更改数据库信息
    $.ajax({
        type:'post',
        url:url,
        data:{'goods_id':goods_id,'num':temp_val},
        dataType:'json',
        success:function (res) {
            // var _res = JSON.parse(res);
            if(res.status == 2){
                alert(res.msg);
            }else{
                //更改上方的购物车总数量
                var a_price = $('.si_num');
                $(a_price).each(function (k,v) {
                    if($(v).attr('goods_id') == goods_id){
                        $(this).val(temp_val);
                    }
                })

                //更改上方购物车每件商品对应的数量
                var d_si_num = $('.d_si_num');
                $(d_si_num).each(function (k,v) {
                    //只有当金额中的goods_id和点击的对用的goods_id相等的时候才更新
                    if($(v).attr('goods_id') == goods_id){
                        $(this).html(temp_val);
                    }
                })

                //更改对应的金额 (总金额/个数)*改变后的个数=新的总金额
                var n_p = (parseFloat($('.c_si_price').html()).toFixed(2)/val)*temp_val;
                var newPrice = Math.round(n_p,2);
                //获取所有下方的金额对象
                var c_si_price = $('.c_si_price');
                $(c_si_price).each(function (k,v) {
                    if($(v).attr('goods_id') == goods_id){
                        $(this).html(newPrice);
                    }
                })

                //获取所有上方的金额对象
                var siPicice = $('.siPicice');
                //循环判断上方的goods_id相同的金额进行更改
                $(siPicice).each(function (k,v) {
                    if($(v).attr('goods_id') == goods_id){
                        $(this).html(newPrice);
                    }
                })

                getAllPrice();
                getAllNum();

                getCALLPrice();
                getCAllNum();
            }

        }
    });
}