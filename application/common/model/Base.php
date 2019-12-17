<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 11:28
 */

namespace app\common\model;


use think\Model;

class Base extends Model
{
    /**
     * 上传一张图片
     * @param $file_name  <input/> 中的name
     * @return  array
     */
    public function uploadOne($file_name){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($file_name);
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->validate(['size'=>300000,'ext'=>'jpg,gif,png'])->move( './uploads');

        if($info){
            //将\改成/，防止linux系统不认识
            $url = str_replace('\\','/',$info->getPathname());
            $img_url = substr($url,1);

            return [
                'status' => 1,
                'img_msg' => $img_url,
            ];
        }else{
            return [
                'status' => 2,
                'img_msg' => $file->getError(),
            ];
        }

    }

    /**
     * 将无限级分类的数据进行排序
     * @param $data  要排序的数据
     * @param int $pid  上级id
     * @param int $level  分层  看多几个小横线
     * @return array
     */
    public function order_data($data, $pid = 0, $level = 0){
        //为了防止初始化，将数据置空，用static声明数组
        static $arr = [];

        foreach ($data as $k=>$v){
            if($pid == $v['pid']){
                $v['level'] = $level;
                $arr[] = $v;
                $this->order_data($data,$v['id'], $level + 1);
            }
        }
        return $arr;
    }

    /**
     * 获取前三层的子类数据
     * @param $data
     * @return array
     */
    public function getChilds($data){
        $arr = [];
        foreach ($data as $k=>$v){
            if($v['pid'] == 0){
                foreach ($data as $k1=>$v1){
                    if($v1['pid'] == $v['id']) {
                        foreach ($data as $k2=>$v2){
                            if($v2['pid'] == $v1['id']){
                                $v1['child'][] = $v2;
                            }
                        }
                        $v['child'][] = $v1;
                    }
                }
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     *  对getChilds方法的数据解释
     * $arr = [
     *   0 =>[
     *          'id' => 18,
     *          'cate_name' => '家用电器',
     *          'pid' => 0,
     *          'child' => [
     *              0 => [
     *                  'id' => 19,
     *                  'cate_name' => '洗衣机',
     *                  'pid' => 18,
     *                  'child' => [
     *                      0 => [
     *                          'id' => 20,
     *                          'cate_name' => '滚筒洗衣机',
     *                          'pid' => 19
     *                      ],
     *                      1 => [
     *                          'id' => 21,
     *                          'cate_name' => '迷你洗衣机',
     *                          'pid' => 19
     *                      ]
     *                  ]
     *              ],
     *              1 => [
     *                  'id' => 24,
     *                  'cate_name' => '电视',
     *                  'pid' => 18,
     *                  'child' => [
     *                      0 => [
     *                          'id' => 25,
     *                          'cate_name' => '曲面电视机',
     *                          'pid' => 24
     *                      ],
     *                      1 => [
     *                          'id' => 26,
     *                          'cate_name' => '超薄电视机',
     *                          'pid' => 24
     *                      ]
     *                  ]
     *              ]
     *          ]
     *      ]
     * ]
     */
}