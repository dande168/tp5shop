-- 1、管理员表
DROP TABLE IF EXISTS tp_admin;
CREATE TABLE `tp_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `admin_pass` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` varchar(30) NOT NULL DEFAULT '''''' COMMENT '登录IP',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '状态 1：启用 2：停用',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user` (`admin_user`),
  KEY `login_time` (`login_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- 2、管理员角色关联表
DROP TABLE IF EXISTS tp_admin_role;
CREATE TABLE tp_admin_role (
  admin_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  role_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员角色关联表';

-- 3、角色表
DROP TABLE IF EXISTS tp_role;
CREATE TABLE tp_role (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  role_name varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  orders int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY role_name (role_name),
  index (orders)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- 4、角色权限关联表
DROP TABLE IF EXISTS tp_role_auth;
CREATE TABLE tp_role_auth (
  role_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  auth_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限id'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色权限关联表';

-- 5、权限表
DROP TABLE IF EXISTS tp_auth;
CREATE TABLE tp_auth (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  auth_name varchar(30) NOT NULL DEFAULT '' COMMENT '权限名称',
  pid int(10) NOT NULL DEFAULT '0' COMMENT '父id',
  auth_m  varchar(30) NOT NULL DEFAULT '' COMMENT '模块名称',
  auth_c  varchar(30) NOT NULL DEFAULT '' COMMENT '控制器名称',
  auth_f  varchar(30) NOT NULL DEFAULT '' COMMENT '方法名称',
  ids_path  varchar(100) NOT NULL DEFAULT '' COMMENT 'ids路径  比如100,101',
  orders int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY auth_name (auth_name),
  index (orders),
  index (ids_path)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='权限表';
--            ids_path
-- 1   zs  0   0
-- 2   ls  1   0,1
-- 3   ww  2   0,1,2
-- 4   ss  1   0,1

-- 6、品牌表
DROP TABLE IF EXISTS tp_brand;
CREATE TABLE tp_brand (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  brand_name varchar(100) NOT NULL DEFAULT '' COMMENT '品牌名称',
  logo varchar(100) NOT NULL DEFAULT '' COMMENT '商标',
  orders int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY brand_name (brand_name),
  KEY orders (orders)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- 7、分类表
DROP TABLE IF EXISTS tp_category;
CREATE TABLE tp_category (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  cate_name varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  pid int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  orders int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY cate_name (cate_name),
  KEY pid (pid),
  index (orders)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- 8、商品表
DROP TABLE IF EXISTS tp_goods;
CREATE TABLE tp_goods (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  cate_id int(10) unsigned not null DEFAULT  0 comment '分类id',
  brand_id int(10) unsigned not null DEFAULT  0 comment '品牌id',
  goods_name varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  title varchar(100) NOT NULL DEFAULT '' COMMENT '商品标题',
  introduce text DEFAULT '' comment '商品摘要',
  num int(10) unsigned not null default 0 comment '库存',
  price decimal(10,2) not null default 0.00 comment '价格',
  descr text DEFAULT '' comment '商品详情',
  big_pic varchar(100) not null default '' comment '大图',
  small_pic varchar(100) not null default '' comment '小图',
  is_cx enum('1','2') not null default '2' comment '是否促销 1:促销 2:不促销',
  cx_price decimal(10,2) not null default 0.00 comment '促销价格',
  is_new enum('1','2') not null default '2' comment '是否新品 1:新品 2:不是新品',
  is_tj enum('1','2') not null default '2' comment '是否推荐 1:推荐 2:不推荐',
  is_hot enum('1','2') not null default '2' comment '是否热卖 1:热卖 2:不热卖',
  orders int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY goods_name (goods_name),
  KEY cate_id (cate_id),
  index (brand_id),
  index (price),
  index (orders)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='商品表';


-- 9、用户表
DROP TABLE IF EXISTS tp_user;
CREATE TABLE tp_user (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_name varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  user_pass char(32) NOT NULL DEFAULT '' COMMENT '密码',
  email varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  email_code char(32) NOT NULL DEFAULT '' COMMENT '邮箱激活码',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (id),
  UNIQUE KEY user_name (user_name),
  UNIQUE KEY email (email),
  KEY email_code (email_code)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 10、购物车表
DROP TABLE IF EXISTS tp_cart;
CREATE TABLE tp_cart (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  goods_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  num int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  user_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  primary key (id),
  index (goods_id),
  index (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- 11、订单基本信息表
DROP TABLE IF EXISTS tp_order;
CREATE TABLE tp_order (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  order_no varchar(30) not null default '' comment '订单号',
  shr_name varchar(50) not null default '' comment '收货人姓名',
  shr_address varchar(100) not null default '' comment '收货人地址',
  shr_tel varchar(15) not null default '' comment '收货人电话',
  express enum('申通','顺丰') not null default '申通' comment '快递',
  pay_method enum('支付宝','微信') not null default '支付宝' comment '支付方式',
  pay_status enum('支付失败','支付成功') NOT NULL DEFAULT '支付成功' COMMENT '支付状态',
  pay_msg varchar(100) NOT NULL DEFAULT '' COMMENT '支付信息',
  order_price decimal(10,2) not null default 0 comment '订单总金额',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  primary key (id),
  index (user_id),
  index (order_no)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='订单基本信息表';

-- 12、订单商品表
DROP TABLE IF EXISTS tp_order_goods;
CREATE TABLE tp_order_goods (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  order_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  goods_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  num int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  goods_price decimal(10,2) not null default 0 comment '商品*数量后的金额',
  create_time int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  update_time int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  primary key (id),
  index (user_id),
  index (order_id),
  index (goods_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='订单商品表';