<?php
use think\Db;


function la($bian='')
{
    //语言包
    $la = $_SESSION['la'];
    if($la == 'CN')
    {
        include "cn.php";
    }
    if($la == 'FAN')
    {
        include "fan.php";
    }
    if($la == 'EN')
    {
        include "en.php";
    }
    
    return $list[$bian];
}

function p($data)
{
    echo "<pre>";
    print_r($data);
    die;
}

function ajax($data)
{
    echo json_encode($data);
    die;
}
function fintolan($type)
{
    if($type == 999)
    {
        return la('b146');
    }
    if($type == 1000)
    {
        return la('b147');
    }
    if($type == 1001)
    {
        return la('b148');
    }
    if($type == 1002)
    {
        return la('b149');
    }
    if($type == 1003)
    {
        return la('b150');
    }
    if($type == 1004)
    {
        return la('b151');
    }
    if($type == 1006)
    {
        return la('b152');
    }
    if($type == 1007)
    {
        return la('b153');
    }
    if($type == 1008)
    {
        return la('b163');
    }
    if($type == 1009)
    {
        return la('b164');
    }
    if($type == 1010)
    {
        return la('b165');
    }
    if($type == 1011)
    {
        return la('b154');
    }
    if($type == 1012)
    {
        return la('b155');
    }
    if($type == 1013)
    {
        return la('b156');
    }
    if($type == 1014)
    {
        return la('b157');
    }
    if($type == 1015)
    {
        return la('b158');
    }
    if($type == 1016)
    {
        return la('b159');
    }
    if($type == 1017)
    {
        return la('b160');
    }
    if($type == 1018)
    {
        return la('b161');
    }
    if($type == 1019)
    {
        return la('b162');
    }
    if($type == 1020)
    {
        return la('b166');
    }
    if($type == 1021)
    {
        return la('b167');
    }
    if($type == 1022)
    {
        return la('b168');
    }
    if($type == 1023)
    {
        return la('b169');
    }
    if($type == 1024)
    {
        return la('b170');
    }
    if($type == 1025)
    {
        return la('b171');
    }
    if($type == 1026)
    {
        return la('b172');
    }
    if($type == 1027)
    {
        return la('b173');
    }
}
//给上级返利
function fanli($uid,$money)
{
    $userinfo = Db::name('lc_user')->where(['id'=>$uid])->find();
    //把当前用户10个上级都查出来，如果没有就忽略
    $p1 = Db::name('lc_user')->where(['id'=>$userinfo['top']])->find();
    if($p1['levels'] >= 1)
    {
        //如果第一代大于等于vip1 
        addFinance($p1['id'], $money*0.19, 1, '元帅vip1-下级质押奖金-' . 'BG',1007);
        setNumber('LcUser', 'money', $money*0.19, 1, "id = ".$p1['id']);
    }
    
    $p2 = Db::name('lc_user')->where(['id'=>$p1['top']])->find();
    if($p2['levels'] >= 2)
    {
        addFinance($p2['id'], $money*0.18, 1, '元帅vip2-下级质押奖金-' . 'BG',1011);
        setNumber('LcUser', 'money', $money*0.18, 1, "id = ".$p2['id']);
    }
    
    $p3 = Db::name('lc_user')->where(['id'=>$p2['top']])->find();
    if($p3['levels'] >= 3)
    {
        addFinance($p3['id'], $money*0.16, 1, '元帅vip3-下级质押奖金-' . 'BG',1012);
        setNumber('LcUser', 'money', $money*0.16, 1, "id = ".$p3['id']);
    }
    
    $p4 = Db::name('lc_user')->where(['id'=>$p3['top']])->find();
    if($p4['levels'] >= 4)
    {
        addFinance($p4['id'], $money*0.14, 1, '元帅vip4-下级质押奖金-' . 'BG',1013);
        setNumber('LcUser', 'money', $money*0.14, 1, "id = ".$p4['id']);
    }
    
    
    $p5 = Db::name('lc_user')->where(['id'=>$p4['top']])->find();
    if($p5['levels'] >= 5)
    {
        addFinance($p5['id'], $money*0.12, 1, '元帅vip5-下级质押奖金-' . 'BG',1014);
        setNumber('LcUser', 'money', $money*0.12, 1, "id = ".$p5['id']);
    }
    
    $p6 = Db::name('lc_user')->where(['id'=>$p5['top']])->find();
    if($p6['levels'] >= 6)
    {
        addFinance($p6['id'], $money*0.08, 1, '元帅vip6-下级质押奖金-' . 'BG',1015);
        setNumber('LcUser', 'money', $money*0.08, 1, "id = ".$p6['id']);
    }
    
    $p7 = Db::name('lc_user')->where(['id'=>$p6['top']])->find();
    if($p7['levels'] >= 7)
    {
        addFinance($p7['id'], $money*0.06, 1, '元帅vip7-下级质押奖金-' . 'BG',1016);
        setNumber('LcUser', 'money', $money*0.06, 1, "id = ".$p7['id']);
    }
    
    $p8 = Db::name('lc_user')->where(['id'=>$p7['top']])->find();
    if($p8['levels'] >= 8)
    {
        addFinance($p8['id'], $money*0.04, 1, '元帅vip8-下级质押奖金-' . 'BG',1017);
        setNumber('LcUser', 'money', $money*0.04, 1, "id = ".$p8['id']);
    }
    
    $p9 = Db::name('lc_user')->where(['id'=>$p8['top']])->find();
    if($p9['levels'] >= 9)
    {
        addFinance($p9['id'], $money*0.02, 1, '元帅vip9-下级质押奖金-' . 'BG',1018);
        setNumber('LcUser', 'money', $money*0.02, 1, "id = ".$p9['id']);
    }
    
    $p10 = Db::name('lc_user')->where(['id'=>$p9['top']])->find();
    if($p10['levels'] >= 10)
    {
        addFinance($p10['id'], $money*0.01, 1, '元帅vip10-下级质押奖金-' . 'BG',1019);
        setNumber('LcUser', 'money', $money*0.01, 1, "id = ".$p10['id']);
    }
    
    
    
}

function httpPost($url="" ,$requestData=array()){
                
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       
        //普通数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestData));
        $res = curl_exec($curl);

        //$info = curl_getinfo($ch);
        curl_close($curl);
        return $res;
    }