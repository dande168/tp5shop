<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11 0011
 * Time: 10:07
 */

namespace app\admin\controller;


use think\Cache;

class Goods extends Base
{
    public function lst(){

        $data = model('Goods')->sel();
        return view('',['data'=>$data]);
    }

    public function add(){
        if(request()->isPost()){
            try{
                $res = model('Goods')->addData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('添加成功','lst');
        }
        //查询所有的分类
        $cate_data = model('Category')->sel();
        //查询所有的品牌
        $brand_data = model('Brand')->order('orders desc')->select();
        return view('',[
            'cate_data'=>$cate_data,
            'brand_data'=>$brand_data,
        ]);
    }

    public function edit(){
        if(request()->isPost()){
            try{
                $res = model('Goods')->editData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('编辑成功','lst');
        }
        //查询所有的分类
        $cate_data = model('Category')->sel();
        //查询所有的品牌
        $brand_data = model('Brand')->order('orders desc')->select();
        //把id对应的商品信息查出
        $id = input('param.id');
        $data = model('Goods')->find($id);

        return view('',[
            'cate_data'=>$cate_data,
            'brand_data'=>$brand_data,
            'data'=>$data,
        ]);
    }

    public function del(){
        $id = input('param.id');

        //将数据查出
        $rs = model('Goods')->find($id);

        $res = model("Goods")->where('id','=',$id)->delete();
        if($res){
            $arr = [
                'status' => 1,
                'msg' => '删除成功！'
            ];
            //当删除成功后，将对应的图片删除
            @unlink('.'.$rs['big_pic']);
            @unlink('.'.$rs['small_pic']);
        }else{
            $arr = [
                'status' => 2,
                'msg' => '删除失败！'
            ];
        }

        echo json_encode($arr);
        exit;
    }

    /**
     * 使用uploadify插件上传图片
     */
    public function upload_pic(){

        //先从缓存中取出之前上传的图片路径
        $pics_url = cache('pics_url');
        //如果有缓存，就将缓存中对应路径的图片删除掉
        if(!empty($pics_url)){
            @unlink($pics_url['big_pic']);
            @unlink($pics_url['thumb_url']);
        }

        $pic_arr = model('Goods')->uploadOne('upload_pic');
        $arr = [];
        if($pic_arr['status'] == 1){
            $big_pic = $pic_arr['img_msg'];
            $arr['big_pic'] = $big_pic;
            //将大图地址按照.专为数组，在名字上拼接一个_thumb
            $big_arr = explode('.',$big_pic);
            $thumb_url = $big_arr[0].'_thumb.'.$big_arr[1];
            $img = \think\Image::open('.'.$arr['big_pic']);
            //按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
            $img->thumb(433, 325)->save('.'.$thumb_url);
            $arr['small_pic'] = $thumb_url;
            $arr['status'] = 1;

            //将上传成功的图片路径放入缓存
            $pics_url = [
                'big_pic' => '.'.$big_pic,
                'thumb_url' => '.'.$thumb_url,
            ];
            //将数据放入缓存中
            cache('pics_url',$pics_url);
        }else{
            $arr = [
                'status' => 2,
                'msg' => $pic_arr['img_msg'],
            ];
        }
        echo json_encode($arr);
        exit;

    }
}