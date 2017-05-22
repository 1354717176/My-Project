<?php
namespace app\console\producttype\controller;

use app\api\common\controller\Base;
use think\Request;
use think\Db;
/**
 * 门票模块
 * Created by PhpStorm.
 * User: 江龙
 * Date: 2017/3/27
 * Time: 21:58
 */
class Producttype extends Base
{
    public function lists(){
        //每一页显示的数据条数
        $pagesize = 1;
        //当前可以显示的条数为($ye-1)*2+1
        $ye = 3;
        //查找总共有多少条数据
        $all = Db::name('product_type')->count();
        //算出总共有多少你页
        $maxpage = ceil($all/$pagesize);
        //获取当前页数
        $page = 1;
        if(!isset($_GET['page'])){

        }
        else{
            $page = $_GET['page'];
        }
        if($page <= 1){
            $page = 1;
        }
        else if($page>=$maxpage){
            $page = $maxpage;
        }
        else{
            $page = $_GET['page'];
        }
        if($maxpage==0){
            $maxpage =1;
        }
        $this->assign('page',$page);
        $this->assign('ye',$ye);
        $this->assign('maxpage',$maxpage);
        //分页结束
        $lists =  Db::name('product_type')->order(array('createTime'  => 'desc' ))->limit(($page-1)*$pagesize,$pagesize)->select();
        foreach($lists as $key => $value){
            //$ticket[$key]['supplier'] = M('newsimage')->where(array('id' => $value['supplierId']))->select();
            //$ticket[$key]['ScenicSpot'] = M('newsimage')->where(array('id' => $value['ScenicSpotId']))->select();
        }
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    public function addList(){
        if(isset($_GET['id'])){
            $lists =  Db::name('product_type')->where(array('id' => $_GET['id']))->find();
            $this->assign('lists',$lists);
            $this->assign('id',$_GET['id']);
            return $this->fetch();
        }
        else{
            return $this->fetch();
        }
    }
    public function add(){
        $url = 0;
        $data = array(
            'product_type_name' => $_POST['type_name'],
            'sort' => $_POST['sort'],
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::name('product_type')->where(array('id' => $id ))->update($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        else{
            if(Db::name('product_type')->insert($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        return json_encode(array(
            'code' => 500,
            'msg' => '添加失败'
        ));
    }
    public function del(){
        $id = $_GET['id'];
        if(Db::name('product_type')->where(array('id' => $id))->delete()){
            return json_encode(array(
                'code' => 1,
                'success' => 'success'
            ));
        }
        else{
            return json_encode(array(
                'code' => 500,
                'msg'=>'参数输入错误'
            ));
        }
    }
}