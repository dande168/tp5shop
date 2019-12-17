<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:20
 */
namespace app\common\model;

use think\Model;
use app\admin\validate\Role as RoleValidate;

class Role extends Model
{
    //开启自动写入更新时间和创建时间
    protected $autoWriteTimestamp = true;

    public static function init(){
        //添加后的事件
        /***将新添加的管理员的id和角色表的id插入到tp_role_auth(角色权限关联表)中***/
        self::event('after_insert',function ($role){
            $role_id = $role['id'];
            $auth_ids_arr = $role['auth_ids'];
            $flag = true;   //设置一个开关
            //添加管理员对应的角色
            foreach ($auth_ids_arr as $k=>$v){
                $res = db('role_auth')->insert([
                    'role_id' => $role_id,
                    'auth_id' => $v,
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
        self::event('after_update',function ($role){
            $role_id = $role['id'];
            $auth_ids_arr = $role['auth_ids'];
            $db = db('role_auth');
            //现将原来的管理员对应的角色都删除
            $del_res = $db->where('role_id','=',$role_id)->delete();
            //再重新添加管理员对应的角色
            foreach ($auth_ids_arr as $k=>$v){
                $res = $db->insert([
                    'role_id' => $role_id,
                    'auth_id' => $v,
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
        if(empty($dt['auth_ids'])){
            return '请选择权限';
        }

        //先进行数据验证
        $validate = new RoleValidate();
        //验证添加的场景
        if(!$validate->scene('add')->check($dt)){
            return $validate->getError();
        }

        //添加数据     allowField 为true 时， 会自动将不是数据库的字段过滤掉
        $res = $this->data($dt)->allowField(true)->save();
        if(!$res){
            return '添加失败';
        }

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
            $where['update_time'] = ['between',[$start_time,$end_time]];
        }else if(!empty($s_time)){
            //若填写了开始时间，而没有填写结束时间，则只将开始时间写入where
            $where['update_time'] = ['>=',$start_time];
        }else if(!empty($e_time)){
            //若填写了结束时间，而没有填写开始时间，则只将结束时间写入where
            $where['update_time'] = ['<=',$end_time];
        }

        /**************管理员名称*******************/
        $role_name = input('param.role_name');
        if(!empty($role_name)){
            $where['role_name'] = ['=',$role_name];
        }

        // field ：制定查询哪些字段
        // alias : 制定表的别名
        // join : 关联表
        // group_concat : 将内容按照逗号拼接成字符串
        $data = $this->alias('a')
            ->field('a.*,group_concat(c.auth_name) auth_names')
            ->join('role_auth b','a.id = b.role_id','LEFT')
            ->join('auth c','b.auth_id = c.id','LEFT')
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
        if(empty($dt['auth_ids'])){
            return '请选择角色';
        }

        //先进行数据验证
        $validate = new RoleValidate();
        //验证添加的场景
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