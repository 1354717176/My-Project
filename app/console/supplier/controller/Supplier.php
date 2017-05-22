<?php
namespace app\console\supplier\controller;

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
class Supplier extends Base
{
    public function lists(){
        //每一页显示的数据条数
        $pagesize = 20;
        //当前可以显示的条数为($ye-1)*2+1
        $ye = 3;
        //查找总共有多少条数据
        $all = Db::table('fm_gys')->count();
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
        $lists =  Db::name('gys')->order(array('createTime'  => 'desc' ))->limit(($page-1)*$pagesize,$pagesize)->select();
        foreach($lists as $key => $value){
            $data = Db::name('gysfl')->where(array('id' => $value['gys_type']))->find();
            $lists[$key]['gys_type'] = $data['type_name'];
            //$lists[$key]['yy_url'] = unserialize($value['yy_url']);
            //$ticket[$key]['ScenicSpot'] = M('newsimage')->where(array('id' => $value['ScenicSpotId']))->select();
        }
        $this->assign('lists',$lists);
        return $this->fetch();

    }
    public function addList(){
        if(isset($_GET['id'])){
            $ticket =  Db::name('gys')->where(array('id' => $_GET['id']))->find();
            if(($ticket['yy_url'])){
                $ticket['yy_url'] = unserialize($ticket['yy_url']);
                foreach($ticket['yy_url'] as $key => $value){
                    if(count($ticket['yy_url']) == 1){
                        $ticket['input_url'] = $value;
                    }
                    else{
                        if($key == 0){
                            $ticket['input_url'] = $value;
                        }
                        else{
                            $ticket['input_url'] = $ticket['input_url'].'$'.$value;
                        }
                    }
                }
            }
            else{

            }
            $this->assign('list_type',Db::name('gysfl')->select());
            $this->assign('lists',$ticket);
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
        $url = 0;
        if(isset($_POST['yy_url'])){
            $url = explode("$", $_POST['yy_url']);
            $url = serialize($url);
        }
        else{

        }
        $data = array(
            'gys_type' => $_POST['gys_type'],
            'gy_name' => $_POST['gy_name'],
            'fz_name' => $_POST['fz_name'],
            'sex' => $_POST['sex'],
            'tel' => $_POST['tel'],
            'qq' => $_POST['qq'],
            'wchat_nu' => $_POST['wchat_nu'],
            'detail_address' => $_POST['detail_address'],
            'yy_url' => $url,
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::name('gys')->where(array('id' => $id ))->update($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        else{
            if(Db::name('gys')->insert($data)){
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
        if(Db::name('gys')->where(array('id' => $id))->delete()){
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
    public function listsType(){
        //每一页显示的数据条数
        $pagesize = 1;
        //当前可以显示的条数为($ye-1)*2+1
        $ye = 3;
        //查找总共有多少条数据
        $all = Db::name('gysfl')->count();
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
        $lists =  Db::name('gysfl')->order(array('createTime'  => 'desc' ))->limit(($page-1)*$pagesize,$pagesize)->select();
        foreach($lists as $key => $value){
            //$ticket[$key]['supplier'] = M('newsimage')->where(array('id' => $value['supplierId']))->select();
            //$ticket[$key]['ScenicSpot'] = M('newsimage')->where(array('id' => $value['ScenicSpotId']))->select();
        }
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    public function addTypeList(){
        if(isset($_GET['id'])){
            $lists =  Db::name('gysfl')->where(array('id' => $_GET['id']))->find();
            $this->assign('lists',$lists);
            $this->assign('id',$_GET['id']);
            return $this->fetch();
        }
        else{
            return $this->fetch();
        }
    }
    public function addType(){
        $url = 0;
        $data = array(
            'type_name' => $_POST['type_name'],
            'sort' => $_POST['sort'],
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::name('gysfl')->where(array('id' => $id ))->update($data)){
                return json_encode(array(
                    'code' => 1,
                    'msg' => 'success'
                ));
            }
        }
        else{
            if(Db::name('gysfl')->insert($data)){
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
    public function delType(){
        $id = $_GET['id'];
        if(Db::name('gysfl')->where(array('id' => $id))->delete()){
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