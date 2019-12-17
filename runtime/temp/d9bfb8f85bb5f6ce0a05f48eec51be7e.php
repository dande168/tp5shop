<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\index\index.html";i:1514270719;s:88:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\header1.html";i:1514432884;s:87:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\footer.html";i:1514270178;}*/ ?>
<?php
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
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
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
                                    <span id="all_num" class="count">10</span>
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
                                    <input type="hidden" goods_id="<?php echo $v['id']; ?>" class="si_num" name="si_num" value="<?php echo $v['num']; ?>"/>
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
    </header>

<!-- ============================================================= HEADER : END ============================================================= -->		<div id="top-banner-and-menu">
	<div class="container">
		
		<div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
			<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown">
    <div class="head"><i class="fa fa-list"></i> 所有分类</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <?php foreach($data['cate_data'] as $k=>$v): ?>
            <li class="dropdown menu-item">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php echo $v['cate_name']; ?></a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            <?php foreach($v['child'] as $k1=>$v1): ?>
                            <div class="col-md-4">
                                <ul class="list-unstyled">
                                    <li><a href="javascript:void(0);"><?php echo $v1['cate_name']; ?></a></li>
                                    <?php foreach($v1['child'] as $k2=>$v2): ?>
                                    <li><a href="<?php echo url('GoodsList/lst',['cate_id'=>$v2['id']]); ?>"><?php echo $v2['cate_name']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    
                </ul>
            </li><!-- /.menu-item -->
            <?php endforeach; ?>
<!-- ================================== MEGAMENU VERTICAL ================================== -->                    </li>
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->		</div><!-- /.sidemenu-holder -->

		<div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
			<!-- ========================================== SECTION – HERO ========================================= -->
			
<div id="hero">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		
		<div class="item" style="background-image: url(__STATIC__/index/assets/images/sliders/slider01.jpg);"></div><!-- /.item -->

		<div class="item" style="background-image: url(__STATIC__/index/assets/images/sliders/slider03.jpg);"></div><!-- /.item -->

	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTION – HERO : END ========================================= -->			
		</div><!-- /.homebanner-holder -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ========================================= HOME BANNERS ========================================= -->
<section id="banner-holder" class="wow fadeInUp">
    <div class="container">
        <div class="col-xs-12 col-lg-6 no-margin banner">
            <a href="javascript:void(0);">
                <img class="banner-image" alt="" src="__STATIC__/index/assets/images/blank.gif" data-echo="__STATIC__/index/assets/images/banners/banner-narrow-01.jpg" />
            </a>
        </div>
        <div class="col-xs-12 col-lg-6 no-margin text-right banner">
            <a href="javascript:void(0);">
                <img class="banner-image" alt="" src="__STATIC__/index/assets/images/blank.gif" data-echo="__STATIC__/index/assets/images/banners/banner-narrow-02.jpg" />
            </a>
        </div>
    </div><!-- /.container -->
</section><!-- /#banner-holder -->
<!-- ========================================= HOME BANNERS : END ========================================= -->
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" >
                <li class="active"><a href="#featured" data-toggle="tab">推荐商品</a></li>
                <li><a href="#new-arrivals" data-toggle="tab">最新上架</a></li>
                <li><a href="#top-sales" data-toggle="tab">热卖商品</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="featured">
                    <div class="product-grid-holder">
                        <?php foreach($data['goods_tj_data'] as $k=>$v): ?>
                        <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                            <div class="product-item">
                                <?php if($v['is_cx'] == 1): ?>
                                <div class="ribbon red"><span>促销</span></div>
                                <?php endif; if($v['is_hot'] == 1): ?>
                                <div class="ribbon green"><span>热卖</span></div>
                                <?php endif; if($v['is_new'] == 1): ?>
                                <div class="ribbon blue"><span>新品!</span></div>
                                <?php endif; if($v['is_tj'] == 1): ?>
                                <div class="ribbon green"><span>推荐</span></div>
                                <?php endif; ?>
                                <div class="image">
                                    <img alt="" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" width="246px" height="220px"/>
                                </div>
                                <div class="body">
                                    <?php if($v['is_cx'] == 1): ?>
                                        <div class="label-discount green">-<?php echo floor(($v['price']-$v['cx_price'])/$v['price']*100);?>% sale</div>
                                    <?php endif; ?>
                                    <div class="title">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                    </div>
                                    <div class="brand"><?php echo $v['brand_name']; ?></div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">$<?php echo $v['price']; ?></div>
                                    <div class="price-current pull-right">$<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button">加入购物车</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:void(0);">
                            ...</a>
                    </div>
                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">
                        <?php foreach($data['goods_new_data'] as $k=>$v): if($k <= 4): ?>
                        <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                            <div class="product-item">
                                <?php if($v['is_cx'] == 1): ?>
                                <div class="ribbon red"><span>促销</span></div>
                                <?php endif; if($v['is_hot'] == 1): ?>
                                <div class="ribbon green"><span>热卖</span></div>
                                <?php endif; if($v['is_new'] == 1): ?>
                                <div class="ribbon blue"><span>新品!</span></div>
                                <?php endif; if($v['is_tj'] == 1): ?>
                                <div class="ribbon green"><span>推荐</span></div>
                                <?php endif; ?>
                                <div class="image">
                                    <img alt="" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" width="246px" height="220px"/>
                                </div>
                                <div class="body">
                                    <?php if($v['is_cx'] == 1): ?>
                                    <div class="label-discount green">-<?php echo floor(($v['price']-$v['cx_price'])/$v['price']*100);?>% sale</div>
                                    <?php endif; ?>
                                    <div class="title">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                    </div>
                                    <div class="brand"><?php echo $v['brand_name']; ?></div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">$<?php echo $v['price']; ?></div>
                                    <div class="price-current pull-right"><?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button">加入购物车</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; endforeach; ?>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:void(0);">
                            ...</a>
                    </div>
                </div>

                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">
                        <?php foreach($data['goods_hot_data'] as $k=>$v): ?>
                        <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                            <div class="product-item">
                                <?php if($v['is_cx'] == 1): ?>
                                <div class="ribbon red"><span>促销</span></div>
                                <?php endif; if($v['is_hot'] == 1): ?>
                                <div class="ribbon green"><span>热卖</span></div>
                                <?php endif; if($v['is_new'] == 1): ?>
                                <div class="ribbon blue"><span>新品!</span></div>
                                <?php endif; if($v['is_tj'] == 1): ?>
                                <div class="ribbon green"><span>推荐</span></div>
                                <?php endif; ?>
                                <div class="image">
                                    <img alt="" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" width="246px" height="220px"/>
                                </div>
                                <div class="body">
                                    <?php if($v['is_cx'] == 1): ?>
                                    <div class="label-discount green">-<?php echo floor(($v['price']-$v['cx_price'])/$v['price']*100);?>% sale</div>
                                    <?php endif; ?>
                                    <div class="title">
                                        <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                    </div>
                                    <div class="brand"><?php echo $v['brand_name']; ?></div>
                                </div>
                                <div class="prices">
                                    <div class="price-prev">$<?php echo $v['price']; ?></div>
                                    <div class="price-current pull-right">$<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button">加入购物车</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:void(0);">
                            ...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================================= BEST SELLERS ========================================= -->
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">最新商品</h1>

        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-7 no-margin">
                
                <div class="row no-margin">
                    <?php foreach($data['goods_new_data'] as $k=>$v): if($k <= 6): ?>
                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img  width="225" height="167" alt="" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title" style="height: 75px">
                                    <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
                                </div>
                                <div class="brand"><?php echo $v['brand_name']; ?></div>
                            </div>
                            <div class="prices">

                                <div class="price-current text-right">$<?php echo $v['price']; ?></div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button">添加到购物车</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.product-item-holder -->
                    <?php endif; endforeach; ?>
                </div><!-- /.row -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-md-5 no-margin">
                <div class="product-item-holder size-big single-product-gallery small-gallery">
                    
                    <div id="best-seller-single-product-slider" class="single-product-slider owl-carousel">
                        <div class="single-product-gallery-item" id="slide1">
                            <a data-rel="prettyphoto" href="images/products/product-gallery-01.jpg">
                                <img alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->

                        <div class="single-product-gallery-item" id="slide2">
                            <a data-rel="prettyphoto" href="javascript:void(0);">
                                <img alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->

                        <div class="single-product-gallery-item" id="slide3">
                            <a data-rel="prettyphoto" href="javascript:void(0);">
                                <img alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->
                    </div><!-- /.single-product-slider -->

                    <div class="gallery-thumbs clearfix">
                        <ul>
                            <li><a class="horizontal-thumb active" data-target="#best-seller-single-product-slider" data-slide="0" href="#slide1"><img width="67" height="60" alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" /></a></li>
                            <li><a class="horizontal-thumb" data-target="#best-seller-single-product-slider" data-slide="1" href="#slide2"><img width="67" height="60" alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" /></a></li>
                            <li><a class="horizontal-thumb" data-target="#best-seller-single-product-slider" data-slide="2" href="#slide3"><img width="67" height="60" alt="" src="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" data-echo="<?php echo $data['goods_new_data'][0]['small_pic']; ?>" /></a></li>
                        </ul>
                    </div><!-- /.gallery-thumbs -->

                    <div class="body">
                        <div class="label-discount clear"></div>
                        <div class="title">
                            <a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $data['goods_new_data'][0]['goods_name']; ?></a>
                        </div>
                        <div class="brand"><?php echo $data['goods_new_data'][0]['brand_name']; ?></div>
                    </div>
                    <div class="prices text-right">
                        <div class="price-current inline"><?php echo $data['goods_new_data'][0]['price']; ?></div>
                        <a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button big inline">加入购物车</a>
                    </div>
                </div><!-- /.product-item-holder -->
            </div><!-- /.col -->

        </div><!-- /.product-grid-holder -->
    </div><!-- /.container -->
</section><!-- /#bestsellers -->
<!-- ========================================= BEST SELLERS : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
	<div class="container">
		<div class="carousel-holder hover">
			
			<div class="title-nav">
				<h2 class="h1">所有商品</h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div><!-- /.title-nav -->

			<div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php foreach($data['goods_data'] as $k=>$v): ?>
				<div class="no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
                        <?php if($v['is_cx'] == 1): ?>
                        <div class="ribbon red"><span>促销</span></div>
                        <?php endif; if($v['is_hot'] == 1): ?>
                        <div class="ribbon green"><span>热卖</span></div>
                        <?php endif; if($v['is_new'] == 1): ?>
                        <div class="ribbon blue"><span>新品!</span></div>
                        <?php endif; if($v['is_tj'] == 1): ?>
                        <div class="ribbon green"><span>推荐</span></div>
                        <?php endif; ?>
						<div class="image">
							<img alt="" src="<?php echo $v['small_pic']; ?>" data-echo="<?php echo $v['small_pic']; ?>" />
						</div>
						<div class="body">
							<div class="title" style="height: 70px;">
								<a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
							</div>
							<div class="brand"><?php echo $v['brand_name']; ?></div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
						</div>

						<div class="hover-area">
							<div class="add-cart-button">
								<a href="javascript:void(0);" goods_id="<?php echo $v['id']; ?>" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->
                <?php endforeach; ?>

			</div><!-- /#recently-carousel -->

		</div><!-- /.carousel-holder -->
	</div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->
<!-- ========================================= TOP BRANDS ========================================= -->
<section id="top-brands" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder" >
            
            <div class="title-nav">
                <h1>热门品牌</h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->
            
            <div id="owl-brands" class="owl-carousel brands-carousel">

                <?php foreach($data['brand_data'] as $k=>$v): ?>
                <div class="carousel-item">
                    <a href="javascript:void(0);">
                        <img alt="" src="<?php echo $v['logo']; ?>" width="170px" height="100px"/>
                    </a>
                </div><!-- /.carousel-item -->
                <?php endforeach; ?>

            </div><!-- /.brands-caresoul -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#top-brands -->
<!-- ========================================= TOP BRANDS : END ========================================= -->
<!-- ============================================================= FOOTER ============================================================= -->

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
        $('.le-button ').click(function () {
            var goods_id = $(this).attr('goods_id');
            var num = 1;
            $.ajax({
                type:'post',
                url:"<?php echo url('Cart/addCart'); ?>",
                data:{'goods_id':goods_id,'num':num},
                dateType:'json',
                success:function (res) {
                    var _res = JSON.parse(res);
                    if(_res.status == 1){
                        if(confirm('添加成功，是否去购物车结算')){
                            window.location.href = "<?php echo url('Cart/cartList'); ?>";
                        }
                    }else{
                        alert('添加失败');
                    }
                }
            })
        });
    </script>

</body>
</html>