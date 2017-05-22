<?php
namespace app\api\ticket\logic;
use think\Db;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 21:22
 */
class Lists
{
    public function queryList(){
        return Db::name('ticket')->find();
    }
    public function getPage($page,$pagesize){
        $ticket =  Db::name('ticket')->order(array('createTime'  => 'desc' ))->limit(($page-1)*$pagesize,$pagesize)->select();
        foreach($ticket as $key => $value){
            //$ticket[$key]['supplier'] = M('newsimage')->where(array('id' => $value['supplierId']))->select();
            //$ticket[$key]['ScenicSpot'] = M('newsimage')->where(array('id' => $value['ScenicSpotId']))->select();
        }
        return $ticket;
    }
    public function del($id){
        if(Db::name('ticket')->where(array('id' => $id))->delete()){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function get_one_ticket($id){
        $ticket =  Db::name('ticket')->where(array('id' => $id))->find();
        //$ticket['supplier'] = M('newsimage')->where(array('id' => $ticket['supplierId']))->find();
        //$ticket['ScenicSpot'] = M('newsimage')->where(array('id' => $ticket['ScenicSpotId']))->find();
        return $ticket;

    }
    public function upload(){
        if($file = request()->file('upload_suolue')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
// 成功上传后 获取上传信息
// 输出 jpg
                echo $info->getExtension();
// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getSaveName();
// 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();
            }else{
// 上传失败获取错误信息
                echo $file->getError();
            }

        }
        else {
            $files = request()->file('huan_deng_pian_image');
            foreach($files as $file){
// 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
// 成功上传后 获取上传信息
// 输出 jpg
                    echo $info->getExtension();
// 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();
                }else{
// 上传失败获取错误信息
                    echo $file->getError();
                }
            }
        }
    }
   /* public function add(){
        $data = array(
            'productName' => $_POST['productName'],
            'productType' => $_POST['productType'],
            'onePrice' => $_POST['onePrice'],
            'statu' => $_POST['statu'],
            'salePrice' => $_POST['salePrice'],
            'ticketAddress' => $_POST['ticketAddress'],
            'startTime' => $_POST['startTime'],
            'endTime' => $_POST['endTime'],
            'detailAddress' => $_POST['detailAddress'],
            'stock' => $_POST['stock'],
            'thumbnail' => serialize($_POST['thumbnail']),
            'Slide' => serialize($_POST['Slide']),
            'indexRecommend' => $_POST['indexRecommend'],
            'indexBanner' => $_POST['indexBanner'],
            'keyWord' => $_POST['keyWord'],
            'notice' => $_POST['notice'],
            'introduction' => $_POST['introduction'],
            'detail' => $_POST['detail'],
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::table('fm_ticket')->where(array('id' => $id ))->update($data)){
                return 1;
            }
        }
        else{
            if(Db::table('fm_ticket')->insert($data)){
                return 1;
            }
        }
    }
   */
    public function add(){
        $data = array(
            'productName' => $_POST['productName'],
            'productType' => $_POST['productType'],
            'onePrice' => $_POST['onePrice'],
            'statu' => $_POST['statu'],
            'salePrice' => $_POST['salePrice'],
            'ScenicSpotId' => $_POST['ScenicSpotId'],
            'createTime' => date('Y-m-d H:i:s')
        );
        if($id = $_POST['id']){
            if(Db::name('ticket')->where(array('id' => $id ))->update($data)){
                return 1;
            }
        }
        else{
            if(Db::name('ticket')->insert($data)){
                return 1;
            }
        }
    }
}