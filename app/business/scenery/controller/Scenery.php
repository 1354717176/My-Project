<?php
namespace app\business\scenery\controller;

use app\api\common\controller\Base;
use think\Request;
use think\Db;
/**
 * 门票模块
 * Created by PhpStorm.
 * User: yanghuan
 * Date: 2017/3/8
 * Time: 21:58
 */
class Scenery extends Base
{
    public function lists(){
        //每一页显示的数据条数
        $pagesize = 1;
        //当前可以显示的条数为($ye-1)*2+1
        $ye = 3;
        //查找总共有多少条数据
        $all = Db::table('fm_scenery')->count();
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
        $lists =  Db::table('fm_scenery')->order(array('createTime'  => 'desc' ))->limit(($page-1)*$pagesize,$pagesize)->select();
        foreach($lists as $key => $value){
            //$data = Db::table('fm_gysfl')->where(array('id' => $value['gys_type']))->find();
            //$lists[$key]['gys_type'] = $data['type_name'];
            //$lists[$key]['yy_url'] = unserialize($value['yy_url']);
            //$ticket[$key]['ScenicSpot'] = M('newsimage')->where(array('id' => $value['ScenicSpotId']))->select();
        }
        $this->assign('lists',$lists);
        return $this->fetch();

    }
    public function addList(){
        if(isset($_GET['id'])){
            $lists =  Db::table('fm_scenery')->where(array('id' => $_GET['id']))->find();
            if(($lists['thumbnail'])){
                $lists['thumbnail'] = unserialize($lists['thumbnail']);
                foreach($lists['thumbnail'] as $key => $value){
                    if(count($lists['thumbnail']) == 1){
                        $lists['thumbnail_input'] = $value;
                    }
                    else{
                        if($key == 0){
                            $lists['thumbnail_input'] = $value;
                        }
                        else{
                            $lists['thumbnail_input'] = $lists['thumbnail_input'].'$'.$value;
                        }
                    }
                }
            }
            if(($lists['slide'])){
                $lists['slide'] = unserialize($lists['slide']);
                foreach($lists['slide'] as $key => $value){
                    if(count($lists['slide']) == 1){
                        $lists['slide_input'] = $value;
                    }
                    else{
                        if($key == 0){
                            $lists['slide_input'] = $value;
                        }
                        else{
                            $lists['slide_input'] = $lists['slide_input'].'$'.$value;
                        }
                    }
                }
            }
            $this->assign('list_type',Db::table('fm_gysfl')->select());
            $this->assign('lists',$lists);
            $this->assign('id',$_GET['id']);
            //$this->assign('gongtype',Db::table('fm_gys')->select());
            return $this->fetch();
        }
        else{
            $this->assign('list_type',Db::table('fm_gysfl')->select());
            return $this->fetch();
        }
    }
    public function add(){
        $thumbnail = 0;
        $slide = 0;
        if(isset($_POST['thumbnail'])){
            $thumbnail = explode("$", $_POST['thumbnail']);
            $thumbnail = serialize($thumbnail);
        }
        else{

        }
        if(isset($_POST['slide'])){
            $slide = explode("$", $_POST['slide']);
            $slide = serialize($slide);
        }
        else{

        }
        $data = array(
            'scenery_name' => $_POST['scenery_name'],
            'supplier_id' => $_POST['supplier_id'],
            'scennery_address' => $_POST['scennery_address'],
            'leverl' => $_POST['leverl'],
            'stock' => $_POST['stock'],
            'detail_address' => $_POST['detail_address'],
            'thumbnail' => $thumbnail,
            'slide' => $slide,
            'index_recommend' => $_POST['index_recommend'],
            'index_banner' => $_POST['index_banner'],
            'key_word' => $_POST['key_word'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'notice' => $_POST['notice'],
            'brief_introduction' => $_POST['brief_introduction'],
            'scenery_detail' => $_POST['scenery_detail'],
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::table('fm_scenery')->where(array('id' => $id ))->update($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        else{
            if(Db::table('fm_scenery')->insert($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        return json_encode(array(
            'code' => 500,
            'msg' => 'false'
        ));
    }
    public function del(){
        $id = $_GET['id'];
        if(Db::table('fm_scenery')->where(array('id' => $id))->delete()){
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