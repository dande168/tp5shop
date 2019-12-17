<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\goods\lst.html";i:1514270916;s:88:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\header2.html";i:1514432884;s:87:"D:\PHP\xampp\htdocs\project\tp5Shop\public/../application/index\view\layout\footer.html";i:1514270178;}*/ ?>
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
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="single-product">
    <div class="container">

         <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            <div class="single-product-gallery-item" id="slide1">
                <a data-rel="prettyphoto" href="<?php echo $goods_data['big_pic']; ?>">
                    <img style="width: 370px;height: 370px" class="img-responsive" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['big_pic']; ?>" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide2">
                <a data-rel="prettyphoto" href="<?php echo $goods_data['big_pic']; ?>">
                    <img style="width: 370px;height: 370px" class="img-responsive" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['big_pic']; ?>" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide3">
                <a data-rel="prettyphoto" href="<?php echo $goods_data['big_pic']; ?>">
                    <img style="width: 370px;height: 370px" class="img-responsive" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['big_pic']; ?>" />
                </a>
            </div><!-- /.single-product-gallery-item -->
        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide3">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="0" href="#slide1">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide3">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="0" href="#slide1">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide3">
                    <img width="67" alt="" src="<?php echo $goods_data['small_pic']; ?>" data-echo="<?php echo $goods_data['small_pic']; ?>" />
                </a>
            </div><!-- /#owl-single-product-thumbnails -->

            <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div><!-- /.nav-holder -->
            
            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div><!-- /.nav-holder -->

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        
        <div class="no-margin col-xs-12 col-sm-7 body-holder">
    <div class="body">
        <div class="title"><a href="#"><?php echo $goods_data['goods_name']; ?></a></div>
		<div class="availability" style="font-size:15px;margin:0;line-height:30px"><label>库存:</label><span class="available">  <?php echo $goods_data['num']; ?></span></div>
        <p><?php echo $goods_data['title']; ?></p>
        <div class="prices">

            <div class="price-current">￥<?php if($goods_data['is_cx'] == 1): ?><?php echo $goods_data['cx_price']; else: ?><?php echo $goods_data['price']; endif; ?></div>
            <?php if($goods_data['is_cx'] == 1): ?>
            <div class="price-prev">￥<?php echo $goods_data['price']; ?></div>
            <?php endif; ?>
        </div>

        <div class="qnt-holder">
            <div class="le-quantity">
                <form>
                    <a id="reduce_num" class="minus" href="javascript:void(0);"></a>
                    <input id="quantity" name="quantity" readonly="readonly" type="text" value="1" />
                    <a id="add_num" class="plus" href="javascript:void(0);"></a>
                </form>
            </div>
            <a id="addto-cart" href="javascript:void(0);" class="le-button huge">加入购物车</a>
        </div><!-- /.qnt-holder -->
    </div><!-- /.body -->

</div><!-- /.body-holder -->
    </div><!-- /.container -->
</div><!-- /.single-product -->

<!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
<section id="single-product-tab">
    <div class="container">
        <div class="tab-holder">
            
            <ul class="nav nav-tabs simple" >
                <li class="active"><a href="#description" data-toggle="tab">商品详情</a></li>
                <li><a href="#additional-info" data-toggle="tab">商品明细</a></li>
                <li><a href="#reviews" data-toggle="tab">评论</a></li>
            </ul><!-- /.nav-tabs -->

            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <?php echo $goods_data['descr']; ?>
                </div><!-- /.tab-pane #description -->

                <div class="tab-pane" id="additional-info">
                    <ul class="tabled-data">
                        <li>
                            <label>weight</label>
                            <div class="value">7.25 kg</div>
                        </li>
                        <li>
                            <label>dimensions</label>
                            <div class="value">90x60x90 cm</div>
                        </li>
                        <li>
                            <label>size</label>
                            <div class="value">one size fits all</div>
                        </li>
                        <li>
                            <label>color</label>
                            <div class="value">white</div>
                        </li>
                        <li>
                            <label>guarantee</label>
                            <div class="value">5 years</div>
                        </li>
                    </ul><!-- /.tabled-data -->

                    <div class="meta-row"></div><!-- /.meta-row -->
                </div><!-- /.tab-pane #additional-info -->


                <div class="tab-pane" id="reviews">
                    <div class="comments">
                        <div class="comment-item">
                            <div class="row no-margin">
                                <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                    <div class="avatar">
                                        <img alt="avatar" src="__STATIC__/index/assets/images/default-avatar.jpg">
                                    </div><!-- /.avatar -->
                                </div><!-- /.col -->

                                <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                    <div class="comment-body">
                                        <div class="meta-info">
                                            <div class="author inline">
                                                <a href="#" class="bold">John Smith</a>
                                            </div>
                                            <div class="star-holder inline">
                                                <div class="star" data-score="4"></div>
                                            </div>
                                            <div class="date inline pull-right">
                                                12.07.2013
                                            </div>
                                        </div><!-- /.meta-info -->
                                        <p class="comment-text">
                                            Integer id purus ultricies nunc tincidunt congue vitae nec felis. Vivamus sit amet nisl convallis, faucibus risus in, suscipit sapien. Vestibulum egestas interdum tellus id venenatis. 
                                        </p><!-- /.comment-text -->
                                    </div><!-- /.comment-body -->

                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </div><!-- /.comment-item -->

                        <div class="comment-item">
                            <div class="row no-margin">
                                <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                    <div class="avatar">
                                        <img alt="avatar" src="__STATIC__/index/assets/images/default-avatar.jpg">
                                    </div><!-- /.avatar -->
                                </div><!-- /.col -->

                                <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                    <div class="comment-body">
                                        <div class="meta-info">
                                            <div class="author inline">
                                                <a href="#" class="bold">Jane Smith</a>
                                            </div>
                                            <div class="star-holder inline">
                                                <div class="star" data-score="5"></div>
                                            </div>
                                            <div class="date inline pull-right">
                                                12.07.2013
                                            </div>
                                        </div><!-- /.meta-info -->
                                        <p class="comment-text">
                                            Integer id purus ultricies nunc tincidunt congue vitae nec felis. Vivamus sit amet nisl convallis, faucibus risus in, suscipit sapien. Vestibulum egestas interdum tellus id venenatis. 
                                        </p><!-- /.comment-text -->
                                    </div><!-- /.comment-body -->

                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </div><!-- /.comment-item -->

                        <div class="comment-item">
                            <div class="row no-margin">
                                <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                    <div class="avatar">
                                        <img alt="avatar" src="__STATIC__/index/assets/images/default-avatar.jpg">
                                    </div><!-- /.avatar -->
                                </div><!-- /.col -->

                                <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                    <div class="comment-body">
                                        <div class="meta-info">
                                            <div class="author inline">
                                                <a href="#" class="bold">John Doe</a>
                                            </div>
                                            <div class="star-holder inline">
                                                <div class="star" data-score="3"></div>
                                            </div>
                                            <div class="date inline pull-right">
                                                12.07.2013
                                            </div>
                                        </div><!-- /.meta-info -->
                                        <p class="comment-text">
                                            Integer id purus ultricies nunc tincidunt congue vitae nec felis. Vivamus sit amet nisl convallis, faucibus risus in, suscipit sapien. Vestibulum egestas interdum tellus id venenatis. 
                                        </p><!-- /.comment-text -->
                                    </div><!-- /.comment-body -->

                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </div><!-- /.comment-item -->
                    </div><!-- /.comments -->

                    <div class="add-review row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="new-review-form">
                                <h2>发表评论</h2>
                                <form id="contact-form" class="contact-form" method="post" >
                                    <div class="field-row star-row">
                                        <label>星级评价</label>
                                        <div class="star-holder">
                                            <div id="stars" class="star big" data-score="0"></div>
                                        </div>
                                    </div><!-- /.field-row -->

                                    <div class="field-row">
                                        <label>畅所欲言</label>
                                        <textarea rows="8" class="le-input"></textarea>
                                    </div><!-- /.field-row -->

                                    <div class="buttons-holder">
                                        <button type="submit" class="le-button huge">评价</button>
                                    </div><!-- /.buttons-holder -->
                                </form><!-- /.contact-form -->
                            </div><!-- /.new-review-form -->
                        </div><!-- /.col -->
                    </div><!-- /.add-review -->

                </div><!-- /.tab-pane #reviews -->
            </div><!-- /.tab-content -->

        </div><!-- /.tab-holder -->
    </div><!-- /.container -->
</section><!-- /#single-product-tab -->
<!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
	<div class="container">
		<div class="carousel-holder hover">
			
			<div class="title-nav">
				<h2 class="h1">猜你喜欢</h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div><!-- /.title-nav -->

			<div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php foreach($re_goods_data as $k=>$v): ?>
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
							<div class="title">
								<a href="<?php echo url('Goods/lst',['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a>
							</div>
							<div class="brand"><?php echo $v['brand_name']; ?></div>
						</div>
						<div class="prices">
							<div class="price-current text-right">$<?php if($v['is_cx'] == 1): ?><?php echo $v['cx_price']; else: ?><?php echo $v['price']; endif; ?></div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
								<a href="single-product.html" class="le-button">加入购物车</a>
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
        $(function () {
            $('#stars img').attr('src','__STATIC__/index/assets/images/star-big-off.png');
        })

        //点击增加购物数量
        $('#add_num').click(function () {
            var val = parseInt($("input[name=quantity]").val());
            val = val + 1;
            $("input[name=quantity]").val(val);
        });
        //点击减少购物数量
        $('#reduce_num').click(function () {
            var val = parseInt($("input[name=quantity]").val());
            val = val - 1;
            if(val < 1){
                val = 1;
            }
            $("input[name=quantity]").val(val);
        });

        //点击添加到购物车
        $('#addto-cart').click(function () {
//            var goods_id ="<?php echo $goods_data['id']?>";
            var goods_id ="<?php echo $goods_data['id']; ?>";
            var num = $("input[name=quantity]").val();

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
            });

        });

    </script>

</body>
</html>