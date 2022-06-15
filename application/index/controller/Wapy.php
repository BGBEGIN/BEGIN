<?php

// +----------------------------------------------------------------------
// | ThinkAdmins
// +----------------------------------------------------------------------
// | 版权所有 2014~2019 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://demo.thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 代码仓库3：https://gitee.com/zoujingli/ThinkAdmin
// | github 代码仓库3：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\index\controller;

use library\Controller;
use think\facade\Session;
use think\Db;

/**
 * 登录
 * Class Index
 * @package app\index\controller
 */
class Wapy extends Controller
{
    
    //监听更新状态
    public function updatenft()
    {
        $r = Db::name('lc_chuangshi')->where(['status'=>0])->count();
        if($r <= 0)
        {
            Db::name('lc_chuangshi')->where("id >= 1")->update(['status'=>0]);
        }
    }
    
    //监听余额等等
    public function jianting()
    {
        $list = Db::name('lc_chuangshi')->where(['status'=>0])->order('id asc')->find();
        if($list)
        {
            Db::name('lc_chuangshi')->where(['id'=>$list['id']])->update(['status'=>1]);
            
            $addr = $list['addr']; //监听的收款地址
            $bg   = $list['bg'];   //系统的支付的数量
            $c_id = $list['id'];   //nft ID
            
            //如果是创始NFT
            if($c_id == 1 || $c_id == 2 || $c_id == 3)
            {
                $this->cnft($c_id);
            }else{
                //光子NFT
                $level = 0;
                switch ($c_id) {
                    case '4':
                        $level = 1;
                        break;
                    case '5':
                        $level = 2;
                        break;
                    case '6':
                        $level = 3;
                        break;
                    case '7':
                        $level = 4;
                        break;
                    case '8':
                        $level = 5;
                        break;
                    case '9':
                        $level = 6;
                        break;
                    case '10':
                        $level = 7;
                        break;
                    case '11':
                        $level = 8;
                        break;
                    case '12':
                        $level = 9;
                        break;
                    case '13':
                        $level = 10;
                        break;
                    default:
                        $level = 0;
                        break;
                }
                $this->vipall($addr,$c_id,$level,$bg);
            }
            
            
            
        }
        
    }
    
    
    
    //监听充值状态
    public function chongzhi()
    {
        $addr = '0x3F5D735529b22a516f964e403D8518fE2907825E';
        
        //只查询最近5分钟的交易
        //开始块
        $start_time = time()-300;
        $start_block_url = "https://api.bscscan.com/api?module=block&action=getblocknobytime&timestamp=$start_time&closest=before&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $start_block = file_get_contents($start_block_url);
        $start_block = json_decode($start_block,true);
        $start_block_num = $start_block['result'];
        
        $url = "https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0xCD86A524318aa3dA29969F6a103032dAfDD70870&address=$addr&startblock=$start_block_num&endblock=999999999&sort=asc&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $r = file_get_contents($url);
        $r1 = json_decode($r,true);
        // p($r1);
        if(!empty($r1['result']))
        {
            foreach($r1['result'] as $k=>$v)
            {
                $rs = Db::name('lc_chongzhi')->where(['hashid'=>$v['hash']])->find();
                if(!$rs)
                {
                    $n['froms'] = $v['from'];
                    $n['to']   = $v['to'];
                    $n['amount'] = $v['value'] / 1000000000000000000;
                    $n['add_time'] = time();
                    $n['hashid'] = $v['hash'];
              
                    $userinfo = Db::name('lc_user')->where(['phone'=>$v['from']])->find();
                    $n['uid'] = $userinfo['id'];
                    
                    Db::name('lc_chongzhi')->insert($n);
                    $uid = $userinfo['id'];
                    addFinance($uid, $n['amount'], 1, 'BG划入' . 'BG',1020);
                    setNumber('LcUser', 'money', $n['amount'], 1, "id = $uid");
                }
            }
        }
    }
    
    
    //创始NFT 到账采集
    public function cnft($id)
    {
        
        $list = Db::name('LcChuangshi')->where(['id'=>$id])->find();
        $addr = $list['addr'];
        
        //只查询最近一个小时的交易
        //开始块
        $start_time = time()-3600;
        $start_block_url = "https://api.bscscan.com/api?module=block&action=getblocknobytime&timestamp=$start_time&closest=before&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $start_block = file_get_contents($start_block_url);
        $start_block = json_decode($start_block,true);
        $start_block_num = $start_block['result'];
        
        $url = "https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0xCD86A524318aa3dA29969F6a103032dAfDD70870&address=$addr&startblock=$start_block_num&endblock=999999999&sort=asc&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $r = file_get_contents($url);
        $r1 = json_decode($r,true);
        if(!empty($r1['result']))
        {
            foreach($r1['result'] as $k=>$v)
            {
                $r2 = Db::name('LcChuangshiUser')->where(['txid'=>$v['hash']])->find();
                if(!$r2)
                {
                    $userinfo = Db::name('LcUser')->where(['phone'=>$v['from']])->find();
                    if($userinfo)
                    {
                         $ilist['c_id'] = $list['id'];
                         $ilist['u_id'] = $userinfo['id'];
                         $ilist['u_addr'] = $userinfo['phone'];
                         $ilist['amount'] = $v['value'] / 1000000000000000000;
                         $ilist['add_time'] = time();
                         $ilist['txid'] = $v['hash'];
                         
                         //如果支付金额与 系统设置的金额不一样 忽略 捣乱的
                         if($ilist['amount'] != $list['bg'])
                         {
                             $ilist['status'] = 2;
                         }else{
                             $ilist['status'] = 1;
                         }
                         Db::name('LcChuangshiUser')->insert($ilist);
                    }
                }
            }
        }
    }
    
    
    public function vipall($addr,$c_id,$level,$bg)
    {
        //只查询最近一个小时的交易
        //开始块
        $start_time = time()-3600;
        $start_block_url = "https://api.bscscan.com/api?module=block&action=getblocknobytime&timestamp=$start_time&closest=before&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $start_block = file_get_contents($start_block_url);
        $start_block = json_decode($start_block,true);
        $start_block_num = $start_block['result'];
        
        $url = "https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0xCD86A524318aa3dA29969F6a103032dAfDD70870&address=$addr&startblock=$start_block_num&endblock=999999999&sort=asc&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $r = file_get_contents($url);
        $r1 = json_decode($r,true);
        
        if(!empty($r1['result']))
        {
            foreach($r1['result'] as $k=>$v)
            {
                $r2 = Db::name('LcChuangshiUser')->where(['txid'=>$v['hash']])->find();
                if(!$r2)
                {
                    $userinfo = Db::name('LcUser')->where(['phone'=>$v['from']])->find();
                    if($userinfo)
                    {
                         $ilist['c_id'] = $c_id;
                         $ilist['u_id'] = $userinfo['id'];
                         $ilist['u_addr'] = $userinfo['phone'];
                         $ilist['amount'] = $v['value'] / 1000000000000000000;
                         $ilist['add_time'] = time();
                         $ilist['txid'] = $v['hash'];
                         
                         //如果支付金额与 系统设置的金额不一样 忽略 捣乱的
                         if($ilist['amount'] != $bg)
                         {
                             $ilist['status'] = 2;
                         }else{
                             
                             $manzus = $this->manzu($c_id,$userinfo['id']);
                             if($manzus == 0)
                             {
                                 $ilist['status'] = 3;
                             }else{
                                 $ilist['status'] = 1;
                                 $dengji = Db::name('lc_user')->where(['phone'=>$v['from']])->field('levels')->find();
                                 
                                 //如果升级等级大于 之前等级才更新
                                 if($level > $dengji['levels'])
                                 {
                                     Db::name('lc_user')->where(['phone'=>$v['from']])->update(['levels'=>$level]);
                                 }
                             }
                             
                             
                             
                         }
                         Db::name('LcChuangshiUser')->insert($ilist);
                         
                         
                    }
                   
                    
                }
            }
        }
    }
    
    
    //判断是否满足条件 以防抓包捣乱的
    public function manzu($id,$uid) //id nft的ID  uid 用户ID
    {
        //vip 1 直接满足
        if($id == 4)
        {
            return 1;
        }
        
        $all_zhi = Db::name('lc_user')->where(['top'=>$uid])->select();
        if(!$all_zhi)
        {
            return 0;
        }
        
        $num = 0;
        foreach($all_zhi as $k=>$v)
        {
            $nr = Db::name('lc_chuangshi_user')->where(['u_id'=>$uid])->where("c_id not in(1,2,3)")->find();
            if($nr)
            {
                $num ++;
            }
        }
        
        $is_buy = 0;
        
        if($id == 5)
        {
            if($num>=4)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 6)
        {
            if($num>=5)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 7)
        {
            if($num>=6)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 8)
        {
            if($num>=7)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 9)
        {
            if($num>=8)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 10)
        {
            if($num>=9)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 11)
        {
            if($num>=10)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 12)
        {
            if($num>=11)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        if($id == 13)
        {
            if($num>=12)
            {
                $is_buy = 1;
            }else{
                $is_buy = 0;
            }
        }
        
        if($is_buy == 1)
        {
            return 1;
        }else{
            return 0;
        }
        
        
    }
    
    
    //更新价格接口
    public function jiageup()
    {
        $url1 = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xCD86A524318aa3dA29969F6a103032dAfDD70870&address=0xecc15db57122ed77d66deca1a872f2fbc33ef20f&&tag=latest&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $r1 = json_decode(file_get_contents($url1),true);
        $url2 = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x55d398326f99059fF775485246999027B3197955&address=0xecc15db57122ed77d66deca1a872f2fbc33ef20f&&tag=latest&apikey=QYE33S6Y1N3SAIWHX6UVR8PR7X82GYCVTQ";
        $r2 = json_decode(file_get_contents($url2),true);
        
        $price = $r2['result'] / $r1['result'];
        if($price>0)
        {
            $price = round($price,5);
            $before = Db::name('lc_risk')->where(['id'=>1])->find();
            Db::name('lc_risk')->where(['id'=>1])->update(['i1'=>$price]);
            if($price != $before['i1'])
            {
               $str = "变动信息\n";
               $str .= "流动池BG变动后\t".($r1['result']/1000000000000000000)."\n";
               $str .= "流动池USDT变动后\t".($r2['result']/1000000000000000000)."\n";
               $str .= "BG变动前\t".$before['i1']."\n";
               $str .= "BG变动后\t".$price."\n";
               $str .= "变动时间\n".date('Y-m-d H:i:s');
               
                $url = "https://api.telegram.org/bot5589509386:AAGx2GapF9QWbcTWbub8bSRNJEpVWsGn0ao/sendMessage";
                $data = ['chat_id'=>'-786549245','text'=>$str];
                httpPost($url,$data);
            }
            
       
        }
    }

    
}