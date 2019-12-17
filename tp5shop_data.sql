/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tp5shop

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-12-29 17:04:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'zhangsan', '7884d7957933ff644d42cf739fc6b6bd', '1513223794', '127.0.0.1', '1', '1513060514', '1513220403');
INSERT INTO `tp_admin` VALUES ('2', 'zhangsan1', '7884d7957933ff644d42cf739fc6b6bd', '1513223935', '127.0.0.1', '2', '1513130051', '1513218074');
INSERT INTO `tp_admin` VALUES ('3', 'admin', '74ea263eedb0a4d53f8963d5114f9eae', '1514425633', '127.0.0.1', '1', '1513220279', '1513220279');

-- ----------------------------
-- Table structure for `tp_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_role`;
CREATE TABLE `tp_admin_role` (
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员角色关联表';

-- ----------------------------
-- Records of tp_admin_role
-- ----------------------------
INSERT INTO `tp_admin_role` VALUES ('2', '5');
INSERT INTO `tp_admin_role` VALUES ('3', '2');
INSERT INTO `tp_admin_role` VALUES ('3', '5');
INSERT INTO `tp_admin_role` VALUES ('1', '2');

-- ----------------------------
-- Table structure for `tp_auth`
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth`;
CREATE TABLE `tp_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名称',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父id',
  `auth_m` varchar(30) NOT NULL DEFAULT '' COMMENT '模块名称',
  `auth_c` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `auth_f` varchar(30) NOT NULL DEFAULT '' COMMENT '方法名称',
  `ids_path` varchar(100) NOT NULL DEFAULT '' COMMENT 'ids路径  比如100,101',
  `orders` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_name` (`auth_name`),
  KEY `orders` (`orders`),
  KEY `ids_path` (`ids_path`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of tp_auth
-- ----------------------------
INSERT INTO `tp_auth` VALUES ('101', '管理员管理', '0', '', '', '', '101', '0', '0', '0');
INSERT INTO `tp_auth` VALUES ('102', '管理员管理列表', '101', 'admin', 'Admin', 'lst', '101,102', '0', '1513216641', '1513216641');
INSERT INTO `tp_auth` VALUES ('103', '添加管理员', '102', 'admin', 'Admin', 'add', '101,102,103', '0', '1513216848', '1513216917');
INSERT INTO `tp_auth` VALUES ('104', '编辑管理员', '102', 'admin', 'Admin', 'edit', '101,102,104', '0', '1513216892', '1513216926');
INSERT INTO `tp_auth` VALUES ('105', '删除管理员', '102', 'admin', 'Admin', 'del', '101,102,105', '0', '1513216954', '1513216954');
INSERT INTO `tp_auth` VALUES ('106', '启用管理员', '102', 'admin', 'Admin', 'start', '101,102,106', '0', '1513217198', '1513217198');
INSERT INTO `tp_auth` VALUES ('107', '禁用管理员', '102', 'admin', 'Admin', 'stop', '101,102,107', '0', '1513217219', '1513217219');
INSERT INTO `tp_auth` VALUES ('108', '角色列表', '101', 'admin', 'Role', 'lst', '101,108', '0', '1513217257', '1513217257');
INSERT INTO `tp_auth` VALUES ('109', '添加角色', '108', 'admin', 'Role', 'add', '101,108,109', '0', '1513217281', '1513217281');
INSERT INTO `tp_auth` VALUES ('110', '编辑角色', '108', 'admin', 'Role', 'edit', '101,108,110', '0', '1513217296', '1513217296');
INSERT INTO `tp_auth` VALUES ('111', '删除角色', '108', 'admin', 'Role', 'del', '101,108,111', '0', '1513217316', '1513217316');
INSERT INTO `tp_auth` VALUES ('112', '权限列表', '101', 'admin', 'Auth', 'lst', '101,112', '0', '1513219865', '1513219865');
INSERT INTO `tp_auth` VALUES ('113', '添加权限', '112', 'admin', 'Auth', 'add', '101,112,113', '0', '1513219889', '1513219889');
INSERT INTO `tp_auth` VALUES ('114', '编辑权限', '112', 'admin', 'Auth', 'edit', '101,112,114', '0', '1513219906', '1513219935');
INSERT INTO `tp_auth` VALUES ('115', '删除权限', '112', 'admin', 'Auth', 'del', '101,112,115', '0', '1513219955', '1513219955');
INSERT INTO `tp_auth` VALUES ('116', '产品管理', '0', '', '', '', '116', '0', '1513220002', '1513220002');
INSERT INTO `tp_auth` VALUES ('117', '品牌列表', '116', 'admin', 'Brand', 'lst', '116,117', '0', '1513220031', '1513220031');
INSERT INTO `tp_auth` VALUES ('118', '添加品牌', '117', 'admin', 'Brand', 'add', '116,117,118', '0', '1513220055', '1513220055');
INSERT INTO `tp_auth` VALUES ('119', '编辑品牌', '117', 'admin', 'Brand', 'edit', '116,117,119', '0', '1513220072', '1513220072');
INSERT INTO `tp_auth` VALUES ('120', '删除品牌', '117', 'admin', 'Brand', 'del', '116,117,120', '0', '1513220088', '1513220088');
INSERT INTO `tp_auth` VALUES ('121', '分类列表', '116', 'admin', 'Category', 'lst', '116,121', '0', '1513220114', '1513220114');
INSERT INTO `tp_auth` VALUES ('122', '添加分类', '121', 'admin', 'Category', 'add', '116,121,122', '0', '1513220133', '1513220133');
INSERT INTO `tp_auth` VALUES ('123', '编辑分类', '121', 'admin', 'Category', 'edit', '116,121,123', '0', '1513220154', '1513220154');
INSERT INTO `tp_auth` VALUES ('124', '删除分类', '121', 'admin', 'Category', 'del', '116,121,124', '0', '1513220173', '1513220173');
INSERT INTO `tp_auth` VALUES ('125', '商品列表', '116', 'admin', 'Goods', 'lst', '116,125', '0', '1513303710', '1513303710');
INSERT INTO `tp_auth` VALUES ('126', '添加商品', '125', 'admin', 'Goods', 'add', '116,125,126', '0', '1513303740', '1513303740');
INSERT INTO `tp_auth` VALUES ('127', '编辑商品', '125', 'admin', 'Goods', 'edit', '116,125,127', '0', '1513303764', '1513303764');
INSERT INTO `tp_auth` VALUES ('128', '删除商品', '125', 'admin', 'Goods', 'del', '116,125,128', '0', '1513303793', '1513303793');

-- ----------------------------
-- Table structure for `tp_brand`
-- ----------------------------
DROP TABLE IF EXISTS `tp_brand`;
CREATE TABLE `tp_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT '商标',
  `orders` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `brand_name` (`brand_name`),
  KEY `orders` (`orders`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of tp_brand
-- ----------------------------
INSERT INTO `tp_brand` VALUES ('1', '苹果', '/uploads/20171219/7134a34dcdf31f4f920f3f56231343c8.jpg', '0', '1512982468', '1513665585');
INSERT INTO `tp_brand` VALUES ('2', '华为', '/uploads/20171219/3aa883fa0ca8d5d9651e60a5def07206.jpg', '0', '1513304188', '1513665599');
INSERT INTO `tp_brand` VALUES ('3', '小米', '/uploads/20171219/11eeeb04b5c7d2811f050dfd847e13f7.jpg', '100', '1513568970', '1513665546');
INSERT INTO `tp_brand` VALUES ('4', 'oppo', '/uploads/20171219/f49b21268dbde836646245a21ad83ad7.jpg', '0', '1513568984', '1513665616');
INSERT INTO `tp_brand` VALUES ('5', '诺基亚', '/uploads/20171219/f4b1fe6dacb6c413635a85ea8118a293.jpg', '50', '1513568999', '1513665559');
INSERT INTO `tp_brand` VALUES ('6', '夏普', '/uploads/20171219/0f679e4ddc3bf0168a7362a4edbe739c.jpg', '0', '1513650739', '1513650789');

-- ----------------------------
-- Table structure for `tp_cart`
-- ----------------------------
DROP TABLE IF EXISTS `tp_cart`;
CREATE TABLE `tp_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of tp_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_category`
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `orders` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cate_name` (`cate_name`),
  KEY `pid` (`pid`),
  KEY `orders` (`orders`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` VALUES ('1', '手机/运营商/数码', '0', '0', '0', '1512964358');
INSERT INTO `tp_category` VALUES ('2', '手机通讯', '1', '1', '0', '1512981766');
INSERT INTO `tp_category` VALUES ('3', '运营商', '1', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('4', '手机配件', '1', '10', '0', '1512981852');
INSERT INTO `tp_category` VALUES ('5', '手机', '2', '2', '0', '1512981786');
INSERT INTO `tp_category` VALUES ('6', '对讲机', '2', '3', '0', '1512981814');
INSERT INTO `tp_category` VALUES ('7', '合约机', '3', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('8', '选号码', '3', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('9', '手机壳', '4', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('10', '贴膜', '4', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('11', '电脑/办公', '0', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('12', '电脑整机', '11', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('13', '电脑配件', '11', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('14', '笔记本', '12', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('15', '游戏本', '12', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('16', '显示器', '13', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('17', 'CPU', '13', '0', '0', '0');
INSERT INTO `tp_category` VALUES ('18', '家用电器', '0', '100', '1513664425', '1513664425');
INSERT INTO `tp_category` VALUES ('19', '洗衣机', '18', '0', '1513664453', '1513664453');
INSERT INTO `tp_category` VALUES ('20', '滚筒洗衣机', '19', '0', '1513664481', '1513664481');
INSERT INTO `tp_category` VALUES ('21', '迷你洗衣机', '19', '0', '1513664492', '1513664492');
INSERT INTO `tp_category` VALUES ('22', '波轮洗衣机', '19', '0', '1513664513', '1513664513');
INSERT INTO `tp_category` VALUES ('23', '烘干机', '19', '0', '1513664523', '1513664523');
INSERT INTO `tp_category` VALUES ('24', '电视', '18', '0', '1513664538', '1513664538');
INSERT INTO `tp_category` VALUES ('25', '曲面电视机', '24', '0', '1513664559', '1513664559');
INSERT INTO `tp_category` VALUES ('26', '超薄电视机', '24', '0', '1513664573', '1513664573');
INSERT INTO `tp_category` VALUES ('27', 'HDR电视机', '24', '0', '1513664586', '1513664586');

-- ----------------------------
-- Table structure for `tp_goods`
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE `tp_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `goods_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '商品标题',
  `introduce` text COMMENT '商品摘要',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `descr` text COMMENT '商品详情',
  `big_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '大图',
  `small_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '小图',
  `is_cx` enum('1','2') NOT NULL DEFAULT '2' COMMENT '是否促销 1:促销 2:不促销',
  `cx_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `is_new` enum('1','2') NOT NULL DEFAULT '2' COMMENT '是否新品 1:新品 2:不是新品',
  `is_tj` enum('1','2') NOT NULL DEFAULT '2' COMMENT '是否推荐 1:推荐 2:不推荐',
  `is_hot` enum('1','2') NOT NULL DEFAULT '2' COMMENT '是否热卖 1:热卖 2:不热卖',
  `orders` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_name` (`goods_name`),
  KEY `cate_id` (`cate_id`),
  KEY `brand_id` (`brand_id`),
  KEY `price` (`price`),
  KEY `orders` (`orders`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of tp_goods
-- ----------------------------
INSERT INTO `tp_goods` VALUES ('1', '5', '2', '荣耀8 4GB+64GB 全网通4G手机 珠光白', '领券立减200！低至1499！双镜头，双2.5D玻璃，双功能指纹！荣耀爆款立省1000！选品质，购荣耀&gt;&gt;&gt;&gt;&gt;', '促　　销\r\n满送 满19元即赠热销商品，赠完即止 详情 &gt;&gt;', '0', '1899.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171219/1513650912.jpg\" title=\"1513650912.jpg\" alt=\"js1.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513650916.jpg\" title=\"1513650916.jpg\" alt=\"js2.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513650918.jpg\" title=\"1513650918.jpg\" alt=\"js3.jpg\" /></p>', '/uploads/20171219/169d05caaa074c6da27731147228c13f.jpg', '/uploads/20171219/169d05caaa074c6da27731147228c13f_thumb.jpg', '1', '1699.00', '1', '1', '2', '0', '1513650929', '1514356662');
INSERT INTO `tp_goods` VALUES ('2', '5', '1', 'Apple 全球购 iPhone6s 4G智能手机苹果手机 深空灰色', '购买AppleCare+，获得原厂2年整机保修(含电池)，和多达2次意外损坏的保修服务。购买勾选：保障服务、原厂保2年。 选择下方购买方式的【移动】【电信】【联通】优惠购，套餐有优惠，还有话费返还！', '优 　 惠\r\n赠品× 1\r\n（条件：购买1件及以上，赠完即止）\r\n限制 此价格不与套装优惠同时享受', '66', '2550.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171219/1513651360.jpg\" title=\"1513651360.jpg\" alt=\"js1.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651363.jpg\" title=\"1513651363.jpg\" alt=\"js2.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651364.jpg\" title=\"1513651364.jpg\" alt=\"js3.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651366.jpg\" title=\"1513651366.jpg\" alt=\"js4.jpg\" /></p>', '/uploads/20171219/50bb16d6febe69e9d6c88d99e9614379.jpg', '/uploads/20171219/50bb16d6febe69e9d6c88d99e9614379_thumb.jpg', '2', '0.00', '1', '1', '2', '0', '1513651376', '1513666472');
INSERT INTO `tp_goods` VALUES ('3', '5', '6', '夏普 SHARP AQUOS S2 全面屏手机 全网通 4GB+64GB 晶耀黑', '【赠碎屏险+移动电源】限量领券立减，成交价1499！美人尖5.5英寸异形全面屏，好屏好色彩！详情猛戳！', '促　　销\r\n赠品× 1 × 1\r\n（赠完即止）\r\n会员特价限制换购满送\r\n会员特价  请登录 确认是否享受优惠\r\n限制 此价格不与套装优惠同时享受\r\n换购 购买1件可优惠换购热销商品 立即换购 &gt;&gt;\r\n满送 满19元即赠热销商品，赠完即止 详情 &gt;&gt;\r\n展开促销 “换购” “满送” 仅可在购物车任选其一', '94', '1699.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171219/1513651682.jpg\" title=\"1513651682.jpg\" alt=\"js1.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651684.jpg\" title=\"1513651684.jpg\" alt=\"js2.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651686.jpg\" title=\"1513651686.jpg\" alt=\"js3.jpg\" /></p>', '/uploads/20171219/5182a01b85f24820f4d37f4815608ad9.jpg', '/uploads/20171219/5182a01b85f24820f4d37f4815608ad9_thumb.jpg', '2', '0.00', '1', '1', '1', '0', '1513651693', '1513666510');
INSERT INTO `tp_goods` VALUES ('4', '5', '4', 'OPPO R11s 全面屏双摄拍照手机 全网通4G+64G  黑色', '下单可任选运动耳机或灯光音箱！全面屏新旗舰，前后2000W，AI美颜，游戏深度优化，拍照游戏两相宜更多活动请点击》', '促　　销\r\n会员特价  请登录 确认是否享受优惠\r\n限制 此价格不与套装优惠同时享受\r\n满送 满19元即赠热销商品，赠完即止 详情 &gt;&gt;', '94', '2999.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171219/1513651919.jpg\" title=\"1513651919.jpg\" alt=\"js1.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651923.jpg\" title=\"1513651923.jpg\" alt=\"js2.jpg\" /><img src=\"/ueditor/php/upload/image/20171219/1513651925.jpg\" title=\"1513651925.jpg\" alt=\"js3.jpg\" /></p>', '/uploads/20171219/f0e590fe6e8eb3f0ff17583402c1607f.jpg', '/uploads/20171219/f0e590fe6e8eb3f0ff17583402c1607f_thumb.jpg', '2', '0.00', '1', '1', '2', '0', '1513651931', '1513666550');
INSERT INTO `tp_goods` VALUES ('5', '5', '2', '华为 HUAWEI P10 全网通 4GB+64GB 曜石黑 移动联通电信4G手机', '【白条6期免息】麒麟960芯片！wifi双天线设计！徕卡人像摄影！千元全面屏畅享7S新品上市，预定抽奖赢电视》》', '满送 满19元即赠热销商品，赠完即止 详情 &gt;&gt;', '99', '3699.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171219/1513666263.jpg\" title=\"1513666263.jpg\" alt=\"js1.jpg\" /></p>', '/uploads/20171219/fd96899ca209bf80ecc9b20d56d50b15.jpg', '/uploads/20171219/fd96899ca209bf80ecc9b20d56d50b15_thumb.jpg', '1', '3488.00', '1', '1', '1', '0', '1513666275', '1513666603');
INSERT INTO `tp_goods` VALUES ('6', '14', '2', '华为（HUAWEI）MateBook X 13英寸超轻薄笔记本电脑', '标配价值299扩展坞和749正版office！4.4mm微窄边框，屏占比88%，2K IPS，指纹式开机一键登入！', ' 购买1件可优惠换购热销商品 立即换购 &gt;&gt;\r\n满额返券下单满59元且12.31日前完成订单，返千元优惠券圣诞礼包，先到先得 详情 &gt;&gt;', '93', '7988.00', '<p style=\"text-align:center;\"><img src=\"/ueditor/php/upload/image/20171225/1514169504.jpg\" title=\"1514169504.jpg\" alt=\"js1.jpg\" /></p>', '/uploads/20171225/8c6e777e0a2b472fa4d3b1d09c814747.jpg', '/uploads/20171225/8c6e777e0a2b472fa4d3b1d09c814747_thumb.jpg', '2', '0.00', '1', '1', '1', '0', '1514169512', '1514169512');

-- ----------------------------
-- Table structure for `tp_order`
-- ----------------------------
DROP TABLE IF EXISTS `tp_order`;
CREATE TABLE `tp_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_no` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `shr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `shr_address` varchar(100) NOT NULL DEFAULT '' COMMENT '收货人地址',
  `shr_tel` varchar(15) NOT NULL DEFAULT '' COMMENT '收货人电话',
  `express` enum('申通','顺丰') NOT NULL DEFAULT '申通' COMMENT '快递',
  `pay_method` enum('支付宝','微信') NOT NULL DEFAULT '支付宝' COMMENT '支付方式',
  `order_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `pay_status` enum('支付失败','支付成功') NOT NULL DEFAULT '支付成功' COMMENT '支付状态',
  `pay_msg` varchar(100) NOT NULL DEFAULT '' COMMENT '支付信息',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order_no` (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单基本信息表';

-- ----------------------------
-- Records of tp_order
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `tp_order_goods`;
CREATE TABLE `tp_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `order_no` varchar(50) NOT NULL DEFAULT '' COMMENT '订单号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品*数量后的金额',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- ----------------------------
-- Records of tp_order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  `orders` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`),
  KEY `orders` (`orders`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('2', '部长', '0', '0', '1513221876');
INSERT INTO `tp_role` VALUES ('5', '经理', '0', '1513135601', '1513219379');

-- ----------------------------
-- Table structure for `tp_role_auth`
-- ----------------------------
DROP TABLE IF EXISTS `tp_role_auth`;
CREATE TABLE `tp_role_auth` (
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `auth_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限关联表';

-- ----------------------------
-- Records of tp_role_auth
-- ----------------------------
INSERT INTO `tp_role_auth` VALUES ('5', '101');
INSERT INTO `tp_role_auth` VALUES ('5', '102');
INSERT INTO `tp_role_auth` VALUES ('5', '103');
INSERT INTO `tp_role_auth` VALUES ('5', '104');
INSERT INTO `tp_role_auth` VALUES ('5', '105');
INSERT INTO `tp_role_auth` VALUES ('5', '106');
INSERT INTO `tp_role_auth` VALUES ('5', '107');
INSERT INTO `tp_role_auth` VALUES ('5', '108');
INSERT INTO `tp_role_auth` VALUES ('5', '109');
INSERT INTO `tp_role_auth` VALUES ('5', '110');
INSERT INTO `tp_role_auth` VALUES ('5', '111');
INSERT INTO `tp_role_auth` VALUES ('2', '101');
INSERT INTO `tp_role_auth` VALUES ('2', '102');
INSERT INTO `tp_role_auth` VALUES ('2', '116');
INSERT INTO `tp_role_auth` VALUES ('2', '117');
INSERT INTO `tp_role_auth` VALUES ('2', '118');
INSERT INTO `tp_role_auth` VALUES ('2', '119');
INSERT INTO `tp_role_auth` VALUES ('2', '120');

-- ----------------------------
-- Table structure for `tp_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `email_code` char(32) NOT NULL DEFAULT '' COMMENT '邮箱激活码',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`),
  KEY `email_code` (`email_code`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('15', 'lifeng', '7884d7957933ff644d42cf739fc6b6bd', '512691398@qq.com', '', '0', '0');
