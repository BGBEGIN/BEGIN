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
class Home extends Controller
{
    
    public function ceshi()
    {
        la();
    }
    
    //首页
    public function index()
    {
        $addr = $this->app->session->get('addr');
        $this->assign('addr',$addr);
        $id = $this->app->request->get('id');
        $this->assign('id',$id);
        
        $la = $this->app->request->get('la');
        //如果要切换语言 
        if($la)
        {
            $_SESSION['la'] = $la;
        }else{
            //如果没语言默认 中文
            if(empty($_SESSION['la']))
            {
                $_SESSION['la'] = 'EN';
            }
        }
        
        $risk = Db::name('lc_risk')->where(['id'=>1])->find();
        $this->assign('risk',$risk);
        $this->fetch(); 
    }
    
    
    public function hangqing()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
        $this->assign('addr',$addr);
        $this->fetch(); 
    }
    
    
    //光子合约
    public function guangzi()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
        $this->assign('addr',$addr);
        $this->fetch();   
    }
    
    
    //小光子合约
    public function xiaoguangzi()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
        $this->assign('addr',$addr);
        $this->fetch(); 
    }
    
    //注册+登录+token
    public function reg()
    {
        if($this->request->isPost()){
            $data = $this->request->param();
            $addr = $data['addr'];
            if(!$addr)
            {
                ajax(['state'=>201,'msg'=>'address not null']);
            }
            
            $tid = 0;
            if ( isset($data['top'] )) {
                $top = Db::name('LcUser')->where(['id' => $data['top']])->value('id');
                $tid = $top ? $top : 0;
            } else {
                $tid = isset($data['top']) ? $data['top'] : 0;
            }
            
            $r = Db::name('LcUser')->where(['phone'=>$addr])->find();
            if(!$r)
            {
                $add = array(
            	'zcly'=>$_SERVER['SERVER_NAME'],
                'phone'=>$addr,
                'phones'=>$addr,
                'top'=>$tid?:0,
                'logintime'=>time(),
                'money'=>0,
                'clock'=>1,
                'value'=> 0,
                'time'=>date('Y-m-d H:i:s'),
                'ip'=>$this->request->ip(),
				'loginip'=>$this->request->ip(),
                'member'=>8015,
                );
                $uid = Db::name('LcUser')->insertGetId($add);
                if (empty($uid))
                {
                    ajax(['state'=>201,'msg'=>"error"]);
                }
    
                $this->app->session->set('addr', $addr);
                ajax(['state'=>200,'msg'=>'success']);
            }else{
                 $this->app->session->set('addr', $addr);
                 ajax(['state'=>200,'msg'=>'success']);
            }
            
            
        }
    }
    
    //退出登录
    public function logout()
    {
        $this->app->session->set('addr', '');
        msg(la('b139'),2,'/index/home/index');
    }
    
    //NFT首页
    public function mintnft()
    {
         $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
        $this->assign('addr',$addr);
        $this->fetch();
    }
    
    //NFT首页
    public function csnft()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $list = Db::name("LcChuangshi")->where("id in(1,2,3) ")->order("id asc")->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    
    //光子NFT
    public function gznft()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $list = Db::name('lc_chuangshi')->where("id not in(1,2,3)")->select();
        $this->assign('list',$list);
        
        //当前用户等级
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
        
        
        //直推了多少1级
        $vip1 = Db::name('lc_user')->where(['top'=>$userinfo['id'],'levels'=>1])->count();
        $this->assign('vip1',$vip1?$vip1:0);
        
        $this->fetch();
    }
    
    
    //查询购买当前级别是否满足
    public function gnftsel()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        $id = $this->app->request->post('id');
        
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $uid = $userinfo['id'];
        
        //查看当前人 的所有下级购买的 VIP1
        $all_zhi = Db::name('lc_user')->where(['top'=>$uid])->select();
        if(!$all_zhi)
        {
            ajax(['state'=>201,'msg'=>la('b140')]);
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
            ajax(['state'=>200,'msg'=>'success']);
        }else{
            ajax(['state'=>201,'msg'=>la('b140')]);
        }
    }
    
    
    //闪兑页面
    public function exchange()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo = Db::name('LcUser')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
        
        $a = Db::name('lc_order')->where(['type'=>2,'uid'=>$userinfo['id'],'is_win'=>1])->sum('fee');
        $b = Db::name('lc_order')->where(['type'=>2,'uid'=>$userinfo['id'],'is_win'=>1])->sum('ploss');
        $xiao_sum = $a+$b;
        
        //已兑换的额度
        $yi_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id'],'types'=>1002])->sum('money');
       
        $this->assign('dui_sum',number_format(($xiao_sum-$yi_sum),2));
        
        $this->fetch();
    }
    
    public function exchangepost()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        $bgb = $this->app->request->post('bgb','','strip_tags');
        //实际兑换的数量BG
        $aa =  sprintf("%.2f",substr(sprintf("%.3f", $bgb), 0, -2));
        if($aa <= 0)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        $userinfo = Db::name('LcUser')->where(['phone'=>$addr])->find();
        if($aa > $userinfo['bgb_money'])
        {
            ajax(['state'=>201,'msg'=>la('b104')]);
        }
        $uid = $userinfo['id'];
        
        //判断是否玩过小光子合约
        $rr = Db::name('lc_order')->where(['type'=>2])->count();
        if(!$rr)
        {
            ajax(['state'=>201,'msg'=>la('b141')]);
        }
        
        $a = Db::name('lc_order')->where(['type'=>2,'uid'=>$userinfo['id'],'is_win'=>1])->sum('fee');
        $b = Db::name('lc_order')->where(['type'=>2,'uid'=>$userinfo['id'],'is_win'=>1])->sum('ploss');
        $xiao_sum = $a+$b;
        
        //已兑换的额度
        $yi_sum = Db::name('lc_finance')->where(['uid'=>$uid,'types'=>1002])->sum('money');
        
        if($yi_sum + $aa > $xiao_sum)
        {
            ajax(['state'=>201,'msg'=>la('b141')]);
        }
        
        Db::startTrans();
        try {
            //给上级返利
            fanli($uid,$aa*0.5*0.2);
            
            addFinance($uid, $aa, 2, '兑换减少' . 'BGT',1002);
            setNumber('LcUser', 'bgb_money', $aa, 2, "id = $uid");
            
            $bg = $aa * 0.5 *0.8;
            addFinance($uid, $bg, 1, '兑换增加' . 'BG',1003);
            setNumber('LcUser', 'money', $bg, 1, "id = $uid");
            Db::commit();
        }catch (Exception $e) {
            Db::rollback();
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        
        ajax(['state'=>200,'msg'=>la('b142')]);
    }
    
    
    public function zhiyalist()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
        
        $lixi = Db::name('lc_risk')->where(['id'=>1])->find();
        $this->assign('lixi',$lixi);
        
        $type =  $this->app->request->get('type');
        $list = Db::name('lc_zhiya')->where(['status'=>1,'u_id'=>$userinfo['id'],'type'=>$type])->order("id desc")->select();
        foreach($list as $k=>$v)
        {
            $list[$k]['daotime'] = $v['dao_time'] - time();
        }
        $this->assign('type',$type);
        $this->assign('list',$list);
        
        $this->fetch();
    }
    
    public function zhiyajson()
    {
        $addr = $this->app->session->get('addr');

        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $type =  $this->app->request->post('type');
        
        $list = Db::name('lc_zhiya')->field('id,dao_time')->where(['status'=>1,'u_id'=>$userinfo['id'],'type'=>$type])->order("id desc")->select();
        foreach($list as $k=>$v)
        {
            $list[$k]['daotime'] = date('Y/m/d H:i:s',$v['dao_time']);
        }
    
        ajax(['state'=>200,'list'=>$list]);
        
    }
    
    //质押
    public function zhiya()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
                
        $z1 = Db::name('lc_zhiya')->where(['type'=>1,'status'=>1])->sum('amount');
        $z2 = Db::name('lc_zhiya')->where(['type'=>2,'status'=>1])->sum('amount');
        $z3 = Db::name('lc_zhiya')->where(['type'=>3,'status'=>1])->sum('amount');
        $this->assign('z1',$z1?$z1:0);
        $this->assign('z2',$z2?$z2:0);
        $this->assign('z3',$z3?$z3:0);
        

        $m1['amount'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>1,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount');
        $m1['amount_bgb'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>1,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount_bgb');


        $m2['amount'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>2,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount');
        $m2['amount_bgb'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>2,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount_bgb');

        
        $m3['amount'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>3,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount');
        $m3['amount_bgb'] = Db::name('lc_zhiya')->field("id,amount,amount_bgb")->where(['type'=>3,'status'=>1,'u_id'=>$userinfo['id']])->sum('amount_bgb');

 
        $this->assign('m1',$m1);
        $this->assign('m2',$m2);
        $this->assign('m3',$m3);
        
        
        //利息表
        $lixi = Db::name('lc_risk')->where(['id'=>1])->find();
        $this->assign('lixi',$lixi);
        
        
        $this->fetch();
    }
    
    
    //质押POST
    public function zhiyapost()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        $number = $this->app->request->post('number');
        $type   = $this->app->request->post('type');
        $number =  sprintf("%.2f",substr(sprintf("%.3f", $number), 0, -2));
        if($number <= 0)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        if($number < 100)
        {
            ajax(['state'=>201,'msg'=>la('b143').' 100 BG']);
        }
        
        
        $userinfo = Db::name('LcUser')->where(['phone'=>$addr])->find();
        if($number > $userinfo['money'])
        {
            ajax(['state'=>201,'msg'=>la('b96')]);
        }

        $list['u_id'] = $userinfo['id'];
        $list['u_addr'] = $userinfo['phone'];
        $list['type'] = $type;
        $list['amount'] = $number;
        $list['add_time'] = time();
        $list['status'] = 1;
        $list['re_time'] = time();
        $list['zhui_time'] = time();
        if($type == 1)
        {
            $list['dao_time'] = time()+3600*24;
        }
        if($type == 2)
        {
            $list['dao_time'] = time()+3600*24*14;
        }
        if($type == 3)
        {
            $list['dao_time'] = time()+3600*24*30;
        }
        Db::name('lc_zhiya')->insert($list);

        $uid = $userinfo['id'];
        
        addFinance($uid, $number, 2, '质押减少' . 'BG',1004);
        setNumber('LcUser', 'money', $number, 2, "id = $uid");
        
        
        ajax(['state'=>200,'msg'=>la('b144')]);
    }
    
    public function zhiyapost1()
    {
        return;
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        $id = $this->app->request->post('id');
        $r = Db::name('lc_zhiya')->where(['id'=>$id,'status'=>1])->find();
        if(!$r)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        
        if($r['type'] == 1)
        {
            //判断是否满足1个小时
            if(time()-3600 < $r['add_time'])
            {
                ajax(['state'=>201,'msg'=>'一小时后方可操作']);
            }
        }
        
        if($r['type'] == 2)
        {
            $time = 86400 * 14;

            if(time()- $time < $r['add_time'])
            {
                ajax(['state'=>201,'msg'=>'14天后方可操作']);
            }
        }
        
        if($r['type'] == 3)
        {
            $time = 86400 * 30;
            if(time()- $time < $r['add_time'])
            {
                ajax(['state'=>201,'msg'=>'30天后方可操作']);
            }
        }
        
        $userinfo = Db::name('LcUser')->where(['phone'=>$addr])->find();
        $uid = $userinfo['id'];
        addFinance($uid, $r['amount'], 1, '支取BG增加' . 'BG',1005);
        setNumber('LcUser', 'money', $r['amount'], 1, "id = $uid");
        
        Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['status'=>2,'update_time'=>time()]);
        ajax(['state'=>200,'msg'=>'支取成功']);
    }
    
    
    //交易矿池
    public function trading()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
        
        $risk = Db::name('lc_risk')->where(['id'=>1])->find();
        $this->assign('risk',$risk);
        
        
        $start_time = date('Y-m-d');
        $end_time = date('Y-m-d 23:59:59');
        
        // $n1 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 999 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $n1_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 999 ")->sum('money');
        
        // $n2 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1000 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $n2_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1000 ")->sum('money');
        
        // $n3 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1001 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $n3_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1001 ")->sum('money');
        
        $this->assign('n1',0);
        $this->assign('n1_sum',0);
        $this->assign('n2',0);
        $this->assign('n2_sum',0);
        $this->assign('n3',0);
        $this->assign('n3_sum',0);
        
        // $v1 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1007 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v1_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1007 ")->sum('money');
        
        // $v2 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1011 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v2_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1011 ")->sum('money');
        
        // $v3 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1012 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v3_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1012 ")->sum('money');
        
        // $v4 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1013 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v4_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1013 ")->sum('money');
        
        // $v5 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1014 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v5_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1014 ")->sum('money');
        
        // $v6 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1015 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v6_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1015 ")->sum('money');
        
        // $v7 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1016 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v7_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1016 ")->sum('money');
        
        // $v8 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1017 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v8_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1017 ")->sum('money');
        
        // $v9 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1018 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v9_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1018 ")->sum('money');
        
        // $v10 = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1019 and time > '$start_time' and time < '$end_time' ")->sum('money');
        // $v10_sum = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types = 1019 ")->sum('money');
        
        
        $this->assign('v1',0);
        $this->assign('v1_sum',0);
        
        $this->assign('v2',0);
        $this->assign('v2_sum',0);
        
        $this->assign('v3',0);
        $this->assign('v3_sum',0);
        
        $this->assign('v4',0);
        $this->assign('v4_sum',0);
        
        $this->assign('v5',0);
        $this->assign('v5_sum',0);
        
        $this->assign('v6',0);
        $this->assign('v6_sum',0);
        
        $this->assign('v7',0);
        $this->assign('v7_sum',0);
        
        $this->assign('v8',0);
        $this->assign('v8_sum',0);
        
        $this->assign('v9',0);
        $this->assign('v9_sum',0);
        
        $this->assign('v10',0);
        $this->assign('v10_sum',0);

        
        
        $c1 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>1])->count();
        $c2 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>2])->count();
        $c3 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>3])->count();
        $c4 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>4])->count();
        $c5 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>5])->count();
        $c6 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>6])->count();
        $c7 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>7])->count();
        $c8 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>8])->count();
        $c9 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>9])->count();
        $c10 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>10])->count();
        $c11 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>11])->count();
        $c12 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>12])->count();
        $c13 = Db::name('lc_chuangshi_user')->where(['u_id'=>$userinfo['id'],'c_id'=>13])->count();
        
        $this->assign('c1',$c1);
        $this->assign('c2',$c2);
        $this->assign('c3',$c3);
        $this->assign('c4',$c4);
        $this->assign('c5',$c5);
        $this->assign('c6',$c6);
        $this->assign('c7',$c7);
        $this->assign('c8',$c8);
        $this->assign('c9',$c9);
        $this->assign('c10',$c10);
        $this->assign('c11',$c11);
        $this->assign('c12',$c12);
        $this->assign('c13',$c13);
        
        $this->fetch();
    }
    
    //
    public function csmx()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types in(999,1000,1001)")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    public function gzmx()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types in(1007,1011,1012,1013,1014,1015,1016,1017,1018,1019)")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    
    public function zymx()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);

        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types in(1004,1005)")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    
    public function zyymx()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);

        $userinfo = Db::name('lc_user')->where(['phone'=>$addr])->find();
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types in(1008,1009,1010)")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    public function share()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $list = Db::name("LcChuangshi")->order("id asc")->select();
        $this->assign('list',$list);
        
        $userinfo = Db::name('LcUser')->where(['phone'=>$addr])->find();
        
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/index/home/index?id='.$userinfo['id'];
        $this->assign('url',$url);
        
        
        $tui = Db::name('LcUser')->where(['top'=>$userinfo['id']])->order("id desc")->select();
        foreach($tui as $k=>$v)
        {
            $tui[$k]['phone'] = substr($v['phone'],0,5).'******'.substr($v['phone'],-7);
        }
        $this->assign('tui',$tui);
        
        $all_user = Db::name('LcUser')->field('id,phone,top')->order("id desc")->select();
        //人数
        $c_id = $userinfo['id'];

        $all =  $this->getMenuTree($all_user,$c_id);
        
        $level1 = 0;
        $level2 = 0;
        $level3 = 0;
        $level4 = 0;
        $level5 = 0;
        $level6 = 0;
        $level7 = 0;
        $level8 = 0;
        $level9 = 0;
        $level10 = 0;
        foreach($all as $k=>$v)
        {
            if($v['level'] == 1)
            {
                $level1++;
            }
            if($v['level'] == 2)
            {
                $level2++;
            }
            if($v['level'] == 3)
            {
                $level3++;
            }
            if($v['level'] == 4)
            {
                $level4++;
            }
            if($v['level'] == 5)
            {
                $level5++;
            }
            if($v['level'] == 6)
            {
                $level6++;
            }
            if($v['level'] == 7)
            {
                $level7++;
            }
            if($v['level'] == 8)
            {
                $level8++;
            }
            if($v['level'] == 9)
            {
                $level9++;
            }
            if($v['level'] == 10)
            {
                $level10++;
            }
        }
        
        $this->assign('level1',$level1);
        $this->assign('level2',$level2);
        $this->assign('level3',$level3);
        $this->assign('level4',$level4);
        $this->assign('level5',$level5);
        $this->assign('level6',$level6);
        $this->assign('level7',$level7);
        $this->assign('level8',$level8);
        $this->assign('level9',$level9);
        $this->assign('level10',$level10);
        
        $this->fetch();
       
    }
    
    function getMenuTree($arrCat, $parent_id = 0, $level = 0)
    {
        static  $arrTree = array(); //使用static代替global
        if( empty($arrCat)) {
            return FALSE;
        }
        $level++;
        foreach($arrCat as $key => $value)
        {
            if($value['top' ] == $parent_id)
            {
                $value[ 'level'] = $level;
                $arrTree[] = $value;
                unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
                $this->getMenuTree($arrCat, $value[ 'id'], $level);
            }
        }
        return $arrTree;
    }

    //查询是否授权
    public function shouquan()
    {
         $addr = $this->app->session->get('addr');
         $userinfo =  Db::name('LcUser')->where(['phone'=>$addr])->find();
         ajax(['state'=>200,'sstatus'=>1]);
         ajax(['state'=>200,'sstatus'=>$userinfo['sstatus']]);
    }
        
    public function shouquanpost()
    {
         $addr = $this->app->session->get('addr');
         $userinfo =  Db::name('LcUser')->where(['phone'=>$addr])->update(['sstatus'=>1]);

    }
    public function account()
    {
        $addr = $this->app->session->get('addr');
        if(!$addr)
        {
            msg(la('b138'),2,'/index/home/index');
        }
       
        $this->assign('addr',$addr);
        
        $userinfo =  Db::name('LcUser')->where(['phone'=>$addr])->find();
        $this->assign('userinfo',$userinfo);
        
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("types in(999,1000,1001)")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $list = Db::name('lc_finance')->where(['uid'=>$userinfo['id']])->where("reason like '%BG%'")->order("id desc")->limit(10)->select();
        $this->assign('list',$list);
        
        $this->fetch();
    }
    
    
    public function account_post()
    {
        $m_addr = $this->app->session->get('addr');
        if(!$m_addr)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        $number = $this->app->request->post('number');
        $addr   = $this->app->request->post('addr');
        $number =  sprintf("%.2f",substr(sprintf("%.3f", $number), 0, -2));
        if($number <= 0)
        {
            ajax(['state'=>201,'msg'=>'error']);
        }
        
        $userinfo = Db::name('LcUser')->where(['phone'=>$m_addr])->find();
    
        $uid = $userinfo['id'];
        if($number > $userinfo['money'])
        {
            ajax(['state'=>201,'msg'=>la('b96')]);
        }
        
        
        addFinance($uid, $number, 2, 'BG划出' . 'BG',1006);
        setNumber('LcUser', 'money', $number, 2, "id = $uid");
        
        $list['u_id'] = $uid;
        $list['u_addr'] = $userinfo['phone'];
        $list['amount'] = $number;
        $list['addr'] = $addr;
        $list['status'] = 0;
        $list['add_time'] = time();
        Db::name('lc_tixian')->insert($list);
        
        ajax(['state'=>200,'msg'=>la('b145')]);
    }
    
    
    
}