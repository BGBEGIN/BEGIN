<?php

namespace app\index\controller;
use library\Controller;
use think\Db;

class Test extends Controller{
    //日利息发放
    public function rilixi()
    {
        $risk = Db::name('lc_risk')->where(['id'=>1])->find();
        $lixi = $risk['rilixi'];
        
        //当前时间
        $time = time()-86400; //
        $r = Db::name('lc_zhiya')->where("status = 1 and type = 1 and re_time < $time and count < 1")->find();
        if($r)
        {
            Db::startTrans();
            try {
                $amount_bgb = $lixi / 100 * $r['amount'];
                addFinance($r['u_id'], $amount_bgb, 1, '质押日利息BGT',1008);
                setNumber('LcUser', 'bgb_money', $amount_bgb, 1, "id = ".$r['u_id']);
                
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['re_time'=>time()]);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('amount_bgb',$amount_bgb);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('count',1);
                
                $rr = Db::name('lc_zhiya')->where(['id'=>$r['id']])->find();
                if($rr['count'] >= 1)
                {
                    //到期
                    addFinance($r['u_id'], $r['amount'], 1, '日利息本金返还BG',1021);
                    setNumber('LcUser', 'money', $r['amount'], 1, "id = ".$r['u_id']);
                    Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['status'=>2,'update_time'=>time()]);
                }
                Db::commit();
            }catch (Exception $e) {
                Db::rollback();
            }
            
        }
        
    }
    
    //周利息发放
    public function zhoulixi()
    {
        $risk = Db::name('lc_risk')->where(['id'=>1])->find();
        $lixi = $risk['zhoulixi'];
        
        //当前时间
        $time = time()-86400; //
        $r = Db::name('lc_zhiya')->where("status = 1 and type = 2 and re_time < $time and count < 14")->find();
        if($r)
        {
            Db::startTrans();
            try {
                $amount_bgb = $lixi / 100 * $r['amount'];
                addFinance($r['u_id'], $amount_bgb, 1, '质押周利息BGT',1009);
                setNumber('LcUser', 'bgb_money', $amount_bgb, 1, "id = ".$r['u_id']);
                
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['re_time'=>time()]);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('amount_bgb',$amount_bgb);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('count',1);
                $rr = Db::name('lc_zhiya')->where(['id'=>$r['id']])->find();
                if($rr['count'] >= 14)
                {
                    //到期
                    addFinance($r['u_id'], $r['amount'], 1, '周利息本金返还BG',1022);
                    setNumber('LcUser', 'money', $r['amount'], 1, "id = ".$r['u_id']);
                    Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['status'=>2,'update_time'=>time()]);
                }
                Db::commit();
            }catch (Exception $e) {
                Db::rollback();
            }
        }
        
    }
    
    
    public function yuelixi()
    {
        $risk = Db::name('lc_risk')->where(['id'=>1])->find();
        $lixi = $risk['yuelixi'];
        
        //当前时间
        $time = time()-86400; //
        $r = Db::name('lc_zhiya')->where("status = 1 and type = 3 and re_time < $time and count < 30")->find();
        if($r)
        {
            Db::startTrans();
            try {
                $amount_bgb = $lixi / 100 * $r['amount'];
                addFinance($r['u_id'], $amount_bgb, 1, '质押月利息BGT',1010);
                setNumber('LcUser', 'bgb_money', $amount_bgb, 1, "id = ".$r['u_id']);
                
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['re_time'=>time()]);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('amount_bgb',$amount_bgb);
                Db::name('lc_zhiya')->where(['id'=>$r['id']])->setInc('count',1);
                
                $rr = Db::name('lc_zhiya')->where(['id'=>$r['id']])->find();
                if($rr['count'] >= 30)
                {
                    //到期
                    addFinance($r['u_id'], $r['amount'], 1, '月利息本金返还BG',1023);
                    setNumber('LcUser', 'money', $r['amount'], 1, "id = ".$r['u_id']);
                    Db::name('lc_zhiya')->where(['id'=>$r['id']])->update(['status'=>2,'update_time'=>time()]);
                }
                
                Db::commit();
            }catch (Exception $e) {
                Db::rollback();
            }
        }
        
    }
    
    
    
    
}