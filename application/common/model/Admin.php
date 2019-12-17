<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:20
 */
namespace app\common\model;

use think\Model;
use app\admin\validate\Admin as AdminValidate;
use think\Validate;

class Admin extends Model
{
    //开启自动写入更新时间和创建时间
    protected $autoWriteTimestamp = true;

    public static function init(){
        //添加后的事件
        /***将新添加的管理员的id和角色表的id插入到tp_admin_role(管理员角色关联表)中***/
        self::event('after_insert',function ($admin){
            $admin_id = $admin['id'];
            $role_ids_arr = $admin['role_ids'];
            $flag = true;   //设置一个开关
            //添加管理员对应的角色
            foreach ($role_ids_arr as $k=>$v){
                $res = db('admin_role')->insert([
                    'admin_id' => $admin_id,
                    'role_id' => $v,
                ]);
                if(!$res){
                    $flag = false;
                    break;
                }
            }

            if($flag){
                return true;
            }else{
                return false;
            }

        });

        //更新后的事件(即调用更新的方法后会自动调用这个事件)
        self::event('after_update',function ($admin){
            $admin_id = $admin['id'];
            $role_ids_arr = $admin['role_ids'];
            $db = db('admin_role');
            //现将原来的管理员对应的角色都删除
            $del_res = $db->where('admin_id','=',$admin_id)->delete();
            //再重新添加管理员对应的角色
            foreach ($role_ids_arr as $k=>$v){
                $res = $db->insert([
                    'admin_id' => $admin_id,
                    'role_id' => $v,
                ]);
            }
        });
    }

    /**
     * 添加
     * @return array|bool|string
     */
    public function addData(){
        $dt = input('post.');

        //判断是否有选择角色
        if(empty($dt['role_ids'])){
            return '请选择角色';
        }

        //先进行数据验证
        $validate = new AdminValidate();
        //验证添加的场景
        if(!$validate->scene('add')->check($dt)){
            return $validate->getError();
        }

        //将密码进行MD5加密
        $password = $dt['admin_pass'];
        //config('admin_base.md5_prefix')   是指获取文件夹extra中的admin_base.php 中的md5_prefix的值
        //md5加密出来的都是32位
        $dt['admin_pass'] = md5(config('admin_base.md5_prefix').$password);

        //往数组中添加登录时间和登录ip
        $dt['login_time'] = time();
        $dt['login_ip'] = request()->ip();  // 获取当前登录人的ip地址

        //添加数据     allowField 为true 时， 会自动将不是数据库的字段过滤掉
        $res = $this->data($dt)->allowField(true)->save();
        if(!$res){
            return '添加失败';
        }

        //此代码已经移动到事件中 即在21行
        /***将新添加的管理员的id和角色表的id插入到tp_admin_role(管理员角色关联表)中***/
//        //获取新插入数据的ID
//        $admin_id = $this->getLastInsID();
//        //获取选择的角色ids
//        $role_id_arr = $dt['role_ids'];
//        foreach ($role_id_arr as $k=>$v){
//            $rs = db('admin_role')->insert([
//                'admin_id' => $admin_id,
//                'role_id' => $v,
//            ]);
//        }

        //当验证通过，并且数据添加成功时 返回true
        return true;
    }

    /**
     * 查询方法
     * @return \think\Paginator
     */
    public function sel(){

        $where = [];
        /********************时间查询(没有秒)*************************/
        //先获取当前提交的时间数据
        $s_time = input('param.start_time');
        $e_time = input('param.end_time');

        //将对应的字符串截取年月日,即2017-12-03,然后拼接上时分秒
        $_start_time = substr($s_time,0,10).' 00:00:00';
        $_end_time = substr($e_time,0,10).' 23:59:59';
        //将拼接好的时分秒进行时间戳转化
        $start_time = strtotime($_start_time);
        $end_time = strtotime($_end_time);

        if(!empty($s_time) && !empty($e_time)){
            //若填写了开始时间和结束时间，将时间用between对where变量进行赋值
            $where['login_time'] = ['between',[$start_time,$end_time]];
        }else if(!empty($s_time)){
            //若填写了开始时间，而没有填写结束时间，则只将开始时间写入where
            $where['login_time'] = ['>=',$start_time];
        }else if(!empty($e_time)){
            //若填写了结束时间，而没有填写开始时间，则只将结束时间写入where
            $where['login_time'] = ['<=',$end_time];
        }

        /**************管理员名称*******************/
        $admin_user = input('param.admin_user');
        if(!empty($admin_user)){
            $where['admin_user'] = ['=',$admin_user];
        }

        // 管理员表 做关联 管理员角色表 ，再关联角色表，将对应的数据查出
        // field ：制定查询哪些字段
        // alias : 制定表的别名
        // join : 关联表
        // group_concat : 将内容按照逗号拼接成字符串
        $data = $this->alias('a')
            ->field('a.id,a.admin_user,a.login_time,a.login_ip,a.status,a.create_time,a.update_time,group_concat(c.role_name) role_names')
            ->join('admin_role b','a.id = b.admin_id','LEFT')
            ->join('role c','b.role_id = c.id','LEFT')
            ->where($where)
            ->group('a.id')
            ->paginate(3);

        //sql打印结果
        /**
         * SELECT `a`.`id`,`a`.`admin_user`,`a`.`login_time`,`a`.`login_ip`,`a`.`status`,`a`.`create_time`,`a`.`update_time`,group_concat(c.role_name) role_names
         * FROM `tp_admin` `a`
         * LEFT JOIN `tp_admin_role` `b` ON `a`.`id`=`b`.`admin_id`
         * LEFT JOIN `tp_role` `c` ON `b`.`role_id`=`c`.`id`
         * LIMIT 0,3
         */

        return $data;
    }

    /**
     * 编辑方法
     * @return array|bool|string
     */
    public function editData(){
        $dt = input('post.');

        //判断是否有选择角色
        if(empty($dt['role_ids'])){
            return '请选择角色';
        }

        $pass = $dt['admin_pass'];
        //当没有填写密码时，表示用原来的密码，把数据中的密码unset
        if(empty($pass)){
            unset($dt['admin_pass']);
        }else{
            //当填写了密码时，进行MD5加密
            $dt['admin_pass'] = md5(config('admin_base.md5_prefix').$pass);
        }

        //验证数据
        $validate = new Validate();
        //验证编辑的场景
        if(!$validate->scene('edit')->check($dt)){
            return $validate->getError();
        }

        $res = $this->allowField(true)->save($dt,['id'=>$dt['id']]);
        if(!$res){
            return '更新失败！';
        }
        return true;
    }
}