<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11 0011
 * Time: 10:21
 */

namespace app\common\model;

use \app\admin\validate\Auth as AuthValidate;
use think\Db;

class Auth extends Base
{

    protected $autoWriteTimestamp = true;

    public static function init(){
        self::event('after_insert',function ($auth){
            //这里的处理都是为了添加ids_path
            //将获取到的pid值 103-101,103  进行字符串转数组处理
            $str = $auth['pid'];
            $arr = explode('-',$str);
            $data['pid'] = $arr['0'];
            $data['ids_path'] = $auth['id'];
            if($arr[1]){
                //将新插入的id拼接到ids_path上
                $data['ids_path'] = $arr['1'].','.$auth['id'];
            }
            //对新插入的数据进行更新
            $res = db('auth')->where('id','=',$auth['id'])->update($data);
        });

        self::event('before_update',function ($auth){
            //这里的处理都是为了添加ids_path
            //将获取到的pid值 103-101,103  进行字符串转数组处理
            $str = $auth['pid'];
            $arr = explode('-',$str);
            $auth['pid'] = $arr['0'];
            //将新插入的id拼接到ids_path上
            //将$auth里的字段更改后，在后面更新是，会自动将$auth里的数据更新到数据库
            $auth['ids_path'] = $arr['1'].','.$auth['id'];


        });
    }

    public function sel(){

        $where = [];
        /**************权限名称*******************/
        $auth_name = input('param.auth_name');
        if(!empty($auth_name)){
            $where['auth_name'] = ['=',$auth_name];
        }

        $data = $this->where($where)->order('ids_path asc')->paginate(15);
        return $data;
    }

    public function addData(){
        $dt = input('post.');

        //参数验证
        $validate = new AuthValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //添加到数据库
        $res = $this->save($dt);
        if(!$res){
            return '添加失败';
        }
        return true;
    }

    public function editData(){
        $dt = input('post.');
        $id = input('post.id');

        //参数验证
        $validate = new AuthValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //编辑到数据库
        $res = $this->save($dt,['id'=> $id]);
        if(!$res){
            return '编辑失败';
        }
        return true;
    }

    /**
     * 获取左边菜单栏的数据
     * @return array
     */
    public function menu(){
        $admin_id = session('ad_id');
        $admin_user = session('ad_user');
        $sql = '';
        if($admin_user == 'admin'){
            $sql = 'select * from tp_auth';
        }else{
            //查出当前登录人所对应的权限数据
            //distinct 去除重复数据
            $sql = "select distinct b.* 
                    from tp_role_auth a
                    left join tp_auth b on a.auth_id = b.id
                    left join tp_admin_role c on  a.role_id = c.role_id
                    where c.admin_id = $admin_id";
        }

        //用原生sql进行查询
        $auth_data = Db::query($sql);

        $data = [];

        //循环获取前两级的权限数据，并把第二级的数据放到对应的第一级的下面
        foreach ($auth_data as $k=>$v){
            if($v['pid'] == 0){
                foreach ($auth_data as $k1=>$v1){
                    if($v1['pid'] == $v['id']){
                        $v['child'][] = $v1;
                    }
                }
                $data[$k] = $v;
            }
        }
        return $data;
    }
}