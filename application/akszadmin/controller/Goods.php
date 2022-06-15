<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
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

namespace app\akszadmin\controller;

use library\Controller;
use think\Db;

/**
 * 产品管理
 * Class Item
 * @package app\akszadmin\controller
 */
class Goods extends Controller
{
    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'LcProduct';
    protected $risk_table = 'LcRisk';

    /**
     * 产品列表
     * @auth true
     * @menu true
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function index()
    {
        $this->title = '产品列表';
        $query = $this->_query($this->table)->like('title');
        $query->order('sort asc,id desc')->page();
    }
     //创始NFT
    public function chuangshiuser()
    {
        $this->title = '用户创始NFT列表';
        $addr = $this->request->param('addr');
        $query = $this->_query('LcChuangshiUser')->where("i.u_addr like '%$addr%' and i.c_id in(1,2,3)")->alias('i')->field('i.*,u.title');
        
        //今日光子合约总交易
        $start_time = strtotime(date('Y-m-d'));
        $end_time  = $start_time + 3600 * 24;
        $today = Db::name('lc_order')->where("pid = 15 and buytime > $start_time and buytime < $end_time")->sum('fee');
        $this->assign('today',$today);
        
        $query->join('lc_chuangshi u','i.c_id=u.id')->order('i.id desc')->page();
    }
    
     public function guangziuser()
    {
        $this->title = '用户光子NFT列表';
        $addr = $this->request->param('addr');
        $query = $this->_query('LcChuangshiUser')->where("i.u_addr like '%$addr%' and i.c_id not in(1,2,3)")->alias('i')->field('i.*,u.title');
        
        //今日光子合约总交易
        $start_time = strtotime(date('Y-m-d'));
        $end_time  = $start_time + 3600 * 24;
        $today = Db::name('lc_order')->where("pid = 15 and buytime > $start_time and buytime < $end_time")->sum('fee');
        $this->assign('today',$today);
        
        $query->join('lc_chuangshi u','i.c_id=u.id')->order('i.id desc')->page();
    }
    
    
    public function zhiya()
    {
        $this->title = '用户质押列表';
        $addr = $this->request->param('addr');
        
        $lixi = Db::name('lc_risk')->where(['id'=>1])->find();
        $this->assign('lixi',$lixi);
        $query = $this->_query('lc_zhiya')->where("u_addr like '%$addr%'");
        $query->order('id desc')->page();
    }
    
    public function chongzhi()
    {
        $this->title = '充值列表';
        $addr = $this->request->param('addr');
        $query = $this->_query('lc_chongzhi')->where("froms like '%$addr%'");
        $query->order('id desc')->page();
    }
    
    public function tixian()
    {
        $this->title = '用户提现列表';
        $addr = $this->request->param('addr');
        $query = $this->_query('lc_tixian')->where("u_addr like '%$addr%'");
        $query->order('id desc')->page();
    }
    
    public function tixian_post()
    {
        $id = $this->request->param('id');
        Db::name('lc_tixian')->where(['id'=>$id])->update(['status'=>1]);
        $this->success('处理成功');
    }
    
    //创始NFT
    public function chuangshi()
    {
        $this->title = 'NFT列表';
        $query = $this->_query('LcChuangshi');
        $query->page();
    }
    
    
    public function chuangshiadd()
    {
        if ($this->request->isGet()) {
            $this->title = '添加NFT';
            $this->_form('LcChuangshi', 'chuangshiadd');
        }else{
            if($_POST['id'])
            {
                $id = $_POST['id'];
                unset($_POST['id']);
                Db::name('LcChuangshi')->where(['id'=>$id])->update($_POST);
                $this->success('修改成功');
            }else{
                $_POST['add_time'] = time();
                Db::name('LcChuangshi')->insert($_POST);
                $this->success('添加成功');
            }
            
        }
        
    }
    public function chuangshiuserfen()
    {
        if ($this->request->isGet()) {
            $today = $this->request->get('today');
            $this->assign('today',$today);
            $this->fetch();
        }else{
            $today = $this->request->post('today');
            $bili = $this->request->post('bili');
            
            $today_sum = $today * $bili /100;
            if($today_sum >0)
            {
                //创始1
                
                $chuangshi1 = Db::name('lc_chuangshi_user')->where(['c_id'=>1])->select();
                $chuangshi1_count = count($chuangshi1);
                if($chuangshi1_count > 0 )
                {
                    $chuangshi1_every = $today_sum * 0.2 / $chuangshi1_count;
                    if($chuangshi1_every >0)
                    {
                        foreach($chuangshi1 as $k=>$v)
                        {
                            addFinance($v['u_id'], $chuangshi1_every, 1,'创始NFT奖励V1'. 'BG',999);
                            setNumber('LcUser', 'money', $chuangshi1_every, 1, "id = ".$v['u_id']);
                        }
                    }
                }
                
                $chuangshi2 = Db::name('lc_chuangshi_user')->where(['c_id'=>2])->select();
                $chuangshi2_count = count($chuangshi2);
                if($chuangshi2_count > 0 )
                {
                    $chuangshi2_every = $today_sum * 0.3 / $chuangshi2_count;
                    if($chuangshi2_every >0)
                    {
                        foreach($chuangshi2 as $k=>$v)
                        {
                            addFinance($v['u_id'], $chuangshi2_every, 1,'创始NFT奖励V2'. 'BG',1000);
                            setNumber('LcUser', 'money', $chuangshi2_every, 1, "id = ".$v['u_id']);
                        }
                    }
                }
                
                $chuangshi3 = Db::name('lc_chuangshi_user')->where(['c_id'=>3])->select();
                $chuangshi3_count = count($chuangshi3);
                if($chuangshi3_count > 0 )
                {
                    $chuangshi3_every = $today_sum * 0.5 / $chuangshi3_count;
                    if($chuangshi3_every >0)
                    {
                        foreach($chuangshi3 as $k=>$v)
                        {
                            addFinance($v['u_id'], $chuangshi3_every, 1,'创始NFT奖励V3'. 'BG',1001);
                            setNumber('LcUser', 'money', $chuangshi3_every, 1, "id = ".$v['u_id']);
                        }
                    }
                }
                
                
                
            }
            
            $this->success('发放成功');
        }
        
    }
    
    public function chuangshiedit()
    {
        $this->title = '编辑创始NFT';
        $this->_form($this->table, 'form');
    }
    
    
    /**
     * 数据列表处理
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function _index_page_filter(&$data)
    {

    }

    /**
     * 添加产品
     * @auth true
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        $this->title = '添加产品';
        $this->_form($this->table, 'form');
    }

    /**
     * 编辑产品
     * @auth true
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function edit()
    {
        $this->title = '编辑产品';
        $this->_form($this->table, 'form');
    }
	/**
     * 状态 开启或者关闭
     * @auth true
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function iskqopen()
    {
        $this->applyCsrfToken();
        $id = $this->request->param('id');
        $iskq = $this->request->param('iskq');
        $this->_save($this->table, ['iskq' => $iskq]);
    }
    
    public function showps(){
    	$this->applyCsrfToken();
        $id = $this->request->param('id');
        $iskq = $this->request->param('do');
        $this->_save($this->table, ['showps' => $iskq]);
    }
    public function showps2(){
    	$this->applyCsrfToken();
        $id = $this->request->param('id');
        $iskq = $this->request->param('do');
        $this->_save($this->table, ['showps2' => $iskq]);
    }
    /**
     * 状态
     * @auth true
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function proisopen()
    {
        $this->applyCsrfToken();
        $id = $this->request->param('id');
        $isopen = $this->request->param('isopen');

        $this->_save($this->table, ['isopen' => $isopen]);
    }
    /**
     * 删除产品
     * @auth true
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function remove()
    {
        $this->applyCsrfToken();
        $this->_delete($this->table);
    }

    /**
     * 表单数据处理
     * @param array $vo
     * @throws \ReflectionException
     */
    protected function _form_filter(&$vo){
        if ($this->request->isGet()) {

        }
    }
    /**
     * 风控管理
     * @auth true
     * @menu true
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function risk()
    {
        $this->title = '运营配置';
        $this->_form($this->risk_table, 'risk');
    }

}
