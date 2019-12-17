<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\order\order.html";i:1514537912;s:88:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\header2.html";i:1514432884;s:87:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\footer.html";i:1514270178;}*/ ?>
<?php
    $_me_data = db('category')->select();
    $me_data = model('category')->getChilds($_me_data);
    $h1_cart_data = model('Cart')->cartDisplay();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="all">

    <title>布塔商城</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="__STATIC__/index/assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="__STATIC__/index/assets/css/main.css">
    <link rel="stylesheet" href="__STATIC__/index/assets/css/red.css">
    <link rel="stylesheet" href="__STATIC__/index/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="__STATIC__/index/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="__STATIC__/index/assets/css/animate.min.css">


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="__STATIC__/index/assets/css/font-awesome.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="__STATIC__/index/assets/images/favicon.ico">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="__STATIC__/index/assets/js/html5shiv.js"></script>
    <script src="__STATIC__/index/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="__STATIC__/index/assets/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/index/assets/myjs/my.js"></script>
</head>
<body>

<div class="wrapper">
    <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <nav class="top-bar animate-dropdown">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <ul>
                    <li><a href="<?php echo url('Index/index'); ?>">首页</a></li>
                    <li><a href="<?php echo url('Cart/cartList'); ?>">我的购物车</a></li>
                    <li><a href="#">我的订单</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 no-margin">
                <ul class="right">
                    您好 , 欢迎您回来 <?php echo \think\Session::get('user_name'); ?> , <a href="<?php echo url('User/logout'); ?>">退出</a>
                    <li><a href="<?php echo url('User/regist'); ?>">注册</a></li>
                    <li><a href="<?php echo url('User/login'); ?>">登录</a></li>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.container -->
    </nav><!-- /.top-bar -->
    <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
    <header>
        <div class="container no-padding">

            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo">
                    <a href="<?php echo url('Index/index'); ?>">
                        <img alt="logo" src="__STATIC__/index/assets/images/logo.png" width="233" height="54"/>
                    </a>
                </div><!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
                <div class="contact-row">
                    <div class="phone inline">
                        <i class="fa fa-phone"></i> (+086) 123 456 7890
                    </div>
                    <div class="contact inline">
                        <i class="fa fa-envelope"></i> contact@<span class="le-color">buta.com</span>
                    </div>
                </div><!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <form>
                        <div class="control-group">
                            <input class="search-field" placeholder="搜索商品" name="search" value="<?php echo \think\Request::instance()->get('search'); ?>"/>

                            <a id="a_search" onclick='a_search("<?php echo url('GoodsList/lst'); ?>");' style="padding:15px 15px 13px 12px" class="search-button" href="javascript:void(0);" ></a>

                        </div>
                    </form>
                </div><!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
                <div class="top-cart-row-container">

                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                    <div class="top-cart-holder dropdown animate-dropdown">

                        <div class="basket">

                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="basket-item-count">
                                    <span id="all_num" class="count">0</span>
                                    <img src="__STATIC__/index/assets/images/icon-cart.png" alt="" />
                                </div>

                                <div class="total-price-basket">
                                    <span class="lbl">您的购物车:</span>
                                    <span class="total-price">
                    <span class="sign">￥</span><span id="allPrice" class="value">0</span>
                    </span>
                                </div>
                            </a>

                            <ul class="dropdown-menu">
                                <?php foreach($h1_cart_data as $k=>$v): ?>
                                <li>
                                    <input type="hidden" class="si_num" goods_id="<?php echo $v['id']; ?>" name="si_num" value="<?php echo $v['num']; ?>"/>
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 no-margin text-center">
                                                <div class="thumb">
                                                    <img width="50px" height="50px" alt="" src="<?php echo $v['small_pic']; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 no-margin">
                                                <div class="title"><?php echo $v['goods_name']; ?></div>
                                                <div class="value">数量：<span goods_id="<?php echo $v['id']; ?>" class="d_si_num"><?php echo $v['num']; ?></span></div>
                                                <div class="price">￥ <span goods_id="<?php echo $v['id']; ?>" class="siPicice"><?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price'] * $v['num']; else: ?><?php echo $v['price'] * $v['num']; endif; ?></span></div>
                                            </div>
                                        </div>
                                        <a class="close-btn" name="upclose" goods_id="<?php echo $v['id']; ?>" onclick="del(this,'/index/Cart/delCart.html');" href="javascript:void(0);"></a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <li class="checkout">
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <a href="<?php echo url('Cart/cartList'); ?>" class="le-button inverse">查看购物车</a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <a href="<?php echo url('Order/order'); ?>" class="le-button">结算</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div><!-- /.basket -->
                    </div><!-- /.top-cart-holder -->
                </div><!-- /.top-cart-row-container -->
                <!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

        </div><!-- /.container -->

        <!-- ========================================= NAVIGATION ========================================= -->
        <nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
            <div class="container">
                <div class="yamm navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div><!-- /.navbar-header -->
                    <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                        <ul class="nav navbar-nav">
                            <?php foreach($me_data as $k=>$v): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?php echo $v['cate_name']; ?></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="yamm-content col-sm-12">
                                            <div class="row">
                                                <?php foreach($v['child'] as $k1=>$v1): ?>
                                                <div class="col-xs-12 col-sm-4">
                                                    <h2><?php echo $v1['cate_name']; ?></h2>
                                                    <ul>
                                                        <?php foreach($v1['child'] as $k2=>$v2): ?>
                                                        <li><a href="#"><?php echo $v2['cate_name']; ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div><!-- /.col -->
                                                <?php endforeach; ?>
                                            </div><!-- /.row -->
                                        </div><!-- /.yamm-content -->
                                    </li>
                                </ul>
                            </li>
                            <?php endforeach; ?>

                        </ul><!-- /.navbar-nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.navbar -->
            </div>
        </nav><!-- /.megamenu-vertical -->
        <!-- ========================================= NAVIGATION : END ========================================= -->
    </header>
<!-- ============================================================= HEADER : END ============================================================= -->		<!-- ========================================= CONTENT ========================================= -->
<form id="form_data" action="<?php echo url('Order/order'); ?>" method="post">
<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">
            <!--<section id="shipping-address" style="margin-bottom:100px;margin-top:-10px">-->
                <!--<h2 class="border h1">收货地址</h2>-->
                    <!--<a href="javascript:void(0);" id="createlink">新建联系人</a>-->

                    <!--<div class="row field-row" style="margin-top:10px">-->
                        <!--<div class="col-xs-12">-->
                            <!--<input class="le-radio big address" type="radio" name="address" value="" checked = "checked"/>厦门市思明区福源大厦-->
                            <!--<a class="simple-link bold" href="#"></a>-->
                        <!--</div>-->
                        <!--<a style="margin-left:45px" href="#">删除</a>-->
                    <!--</div>-->
					<!--&lt;!&ndash; /.field-row &ndash;&gt;-->
            <!--</section>&lt;!&ndash; /#shipping-address &ndash;&gt;-->
            
            <div class="billing-address" style="display:block;">
                <h2 class="border h1">收货地址</h2>
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label>姓名*</label>
                            <input class="le-input" name="shr_name" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label>地址*</label>
                            <input class="le-input" data-placeholder="例如：厦门市思明区福源大厦9楼" name="shr_address" >
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>联系电话*</label>
                            <input class="le-input" name="shr_tel" >
                        </div>
                    </div>

                    <!--<div class="place-order-button">-->
                        <!--<button class="le-button small" >保存</button>-->
                    <!--</div>&lt;!&ndash; /.place-order-button &ndash;&gt;-->
            </div><!-- /.billing-address -->
            <section id="your-order">
                <h2 class="border h1">您的订单详情</h2>
                    <?php foreach($order_goods_data as $k=>$v): ?>
                    <div class="row no-margin order-item">
                        <div class="col-xs-12 col-sm-1 no-margin">
                        <a href="javascript:void(0);" class="qty"><?php echo $v['num']; ?>x</a>
                        </div>

                        <div class="col-xs-12 col-sm-9 ">

                        <div class="title">

                            <a href="#" class="thumb-holder">
                                <img width="150px" height="150px" class="lazy" alt="" src="<?php echo $v['small_pic']; ?>" />
                            </a>
                            <a style="margin-left:50px" href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a></div>
                        </div>

                        <div class="col-xs-12 col-sm-2 no-margin">
                            <div class="price">￥ <span class="order_goods_price"><?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price'] * $v['num']; else: ?><?php echo $v['price'] * $v['num']; endif; ?></span></div>
                        </div>
                    </div><!-- /.order-item -->
                    <?php endforeach; ?>
            </section><!-- /#your-order -->
            <input type="hidden" name="addressid" value>
            <div id="total-area" class="row no-margin">
                <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                    <div id="subtotal-holder">
                        <ul class="tabled-data inverse-bold no-border">
                            <li>
                                <label>商品总价</label>
                                <div style="width:100%;text-align:right" id="total" class="value">￥ <span id="all_goods_price">0</span></div>
                            </li>
                            <li>
                                <label>选择快递</label>
                                <div style="width:100%;text-align:right" class="value">
                                    <div class="radio-group">
                                        <input class="le-radio express" type="radio" name="express" value="申通" data="10"> <div class="radio-label bold">申通快递<span class="bold"> ￥ 10</span></div><br>
                                        <input class="le-radio express" type="radio" name="express" value="顺丰" data="10" checked> <div class="radio-label bold">顺丰快递<span class="bold"> ￥ 10</span></div><br>
                                    </div>
                                </div>
                            </li>
                        </ul><!-- /.tabled-data -->

                        <ul id="total-field" class="tabled-data inverse-bold ">
                            <li>
                                <label>订单总额</label>
                                <div class="value" style="width:100%;text-align:right" id="ototal">￥ <span id="all_order_price">0</span></div>
                            </li>
                        </ul><!-- /.tabled-data -->

                    </div><!-- /#subtotal-holder -->
                </div><!-- /.col -->
            </div><!-- /#total-area -->

            <div id="payment-method-options">
                    
                    <div class="payment-method-option">
                        <!--<input class="le-radio" type="radio" name="pay_method" value="支付宝" checked>-->
                        <!--<div class="radio-label bold ">支付宝支付</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                        <input class="le-radio" type="radio" name="pay_method" value="微信" checked>
                        <div class="radio-label bold ">微信支付</div>
                    </div><!-- /.payment-method-option -->
                    
            </div><!-- /#payment-method-options -->
            
            <div class="place-order-button">
                <button onclick="$('#form_data').submit()" class="le-button big">确认订单</button>
            </div><!-- /.place-order-button -->

        </div><!-- /.col -->
    </div><!-- /.container -->    
</section><!-- /#checkout-page -->
</form>
<!-- ========================================= CONTENT : END ========================================= -->		
<!-- ============================================================= FOOTER ============================================================= --><!-- ============================================================= FOOTER ============================================================= -->

<?php
    //获取推荐商品
    $goods_tj_data = model('Goods')->is_tj();
    //获取热卖商品
    $goods_hot_data = model('Goods')->is_hot();
    //获取最新商品
    $goods_new_data = model('Goods')->is_new();
    //获取促销商品
    $goods_cx_data = model('Goods')->is_cx();

?>
<footer id="footer" class="color-bg">

    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>推荐商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach($goods_tj_data as $k=>$v): ?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                        <div class="price">
                                            <div class="price-prev">￥<?php echo $v['price']; ?></div>
                                            <div class="price-current">￥<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>" class="thumb-holder">
                                            <img alt="电脑" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" />
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>热卖商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach($goods_hot_data as $k=>$v): ?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                        <div class="price">
                                            <div class="price-prev">￥<?php echo $v['price']; ?></div>
                                            <div class="price-current">￥<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>" class="thumb-holder">
                                            <img alt="电脑" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" />
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>最新商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach($goods_new_data as $k=>$v): ?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                        <div class="price">
                                            <div class="price-prev">￥<?php echo $v['price']; ?></div>
                                            <div class="price-current">￥<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 no-margin">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>" class="thumb-holder">
                                            <img alt="电脑" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" />
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div><!-- /.widget -->
                <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

        </div><!-- /.widgets-row-->
    </div><!-- /.container -->

    <div class="sub-form-row">
        <!--<div class="container">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                <form role="form">
                    <input placeholder="Subscribe to our newsletter">
                    <button class="le-button">Subscribe</button>
                </form>
            </div>
        </div>--><!-- /.container -->
    </div><!-- /.sub-form-row -->

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
                <div class="contact-info">
                    <div class="footer-logo">
                        <img alt="logo" src="__STATIC__/index/assets/images/logo.PNG" width="233" height="54"/>
                    </div><!-- /.footer-logo -->

                    <p class="regular-bold"> 请通过电话，电子邮件随时联系我们</p>

                    <p>
                        福源大厦9楼, 厦门市思明区, 中国
                        <br>布塔信息科技
                    </p>

                    <!--<div class="social-icons">
                        <h3>Get in touch</h3>
                        <ul>
                            <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-pinterest"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                            <li><a href="#" class="fa fa-stumbleupon"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li>
                            <li><a href="#" class="fa fa-vk"></a></li>
                        </ul>
                    </div>--><!-- /.social-icons -->

                </div>
                <!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
                <div class="link-widget">
                    <div class="widget">
                        <h3>最新商品</h3>
                        <?php foreach($goods_new_data as $k=>$v): ?>
                        <ul>
                            <li><a href="#"><?php echo $v['goods_name']; ?></a></li>
                        </ul>
                        <?php endforeach; ?>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>热门商品</h3>
                        <?php foreach($goods_hot_data as $k=>$v): ?>
                        <ul>
                            <li><a href="#"><?php echo $v['goods_name']; ?></a></li>
                        </ul>
                        <?php endforeach; ?>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>促销商品</h3>
                        <?php foreach($goods_cx_data as $k=>$v): ?>
                        <ul>
                            <li><a href="#"><?php echo $v['goods_name']; ?></a></li>
                        </ul>
                        <?php endforeach; ?>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->
                <!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    &copy; <a href="#">buta.com</a> - all rights reserved
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="__STATIC__/index/assets/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="__STATIC__/index/assets/images/payments/payment-master.png"></li>
                        <li><img alt="" src="__STATIC__/index/assets/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="__STATIC__/index/assets/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="__STATIC__/index/assets/js/jquery-1.10.2.min.js"></script>
	<script src="__STATIC__/index/assets/js/jquery-migrate-1.2.1.js"></script>
	<script src="__STATIC__/index/assets/js/bootstrap.min.js"></script>
	<script src="__STATIC__/index/assets/js/gmap3.min.js"></script>
	<script src="__STATIC__/index/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="__STATIC__/index/assets/js/owl.carousel.min.js"></script>
	<script src="__STATIC__/index/assets/js/css_browser_selector.min.js"></script>
	<script src="__STATIC__/index/assets/js/echo.min.js"></script>
	<script src="__STATIC__/index/assets/js/jquery.easing-1.3.min.js"></script>
	<script src="__STATIC__/index/assets/js/bootstrap-slider.min.js"></script>
    <script src="__STATIC__/index/assets/js/jquery.raty.min.js"></script>
    <script src="__STATIC__/index/assets/js/jquery.prettyPhoto.min.js"></script>
    <script src="__STATIC__/index/assets/js/jquery.customSelect.min.js"></script>
    <script src="__STATIC__/index/assets/js/wow.min.js"></script>
	<script src="__STATIC__/index/assets/js/scripts.js"></script>
    <script>
        $(function () {
            var order_goods_price = $('.order_goods_price');
            var all_goods_price = 0;
            $(order_goods_price).each(function (k,v) {
                var price = parseFloat($(v).html());
                all_goods_price += price;
            });
            $('#all_goods_price').html(all_goods_price);
            $('#all_order_price').html(all_goods_price + 10);
        })
    </script>

</body>
</html>