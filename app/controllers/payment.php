<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
    //支付类型
    private $payment_type = "1";
    //必填，不能修改
    //服务器异步通知页面路径
    private $notify_url = 'http://www.170es.com/payment/alipaynotify';//base_url()."http://www.yuexingtrip.com/";
    //需http://格式的完整路径，不能加?id=123这类自定义参数

    //页面跳转同步通知页面路径
    private $return_url = 'http://www.170es.com/payment/alipayreturn';//base_url().asset('pay/alipay-return');//"http://www.yuexingtrip.com/pay/alipay-return";
    //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

    //卖家支付宝帐户
    private $seller_email = 'yixin-es@qq.com';
    
    private $alipayPath = 'app/libraries/alipay/';
    //必填
    function __construct()
    {
        parent::__construct();
        //$this->alipayPath = ;
        $this->load->model('pay');
        $this->load->model('order');
        //$this->notify_url = base_url().'payment/alipaynotify';
        //$this->return_url = base_url().'payment/alipayreturn';
    }

	public function index()
	{
        $this->auth->check_login();
        $user_id = $this->auth->user_id();
        $post = $this->input->post();
        $orderId = trim($post['orderid']);
        $pay_type = trim($post['pay_type']);
        $bank_name = trim($post['bank_name']);
        $payType = $this->pay->payType();

        
        if(!$orderId || !in_array($pay_type, $payType))
        {
            show_error($this->lang->line('param_error'),500);
        }
        $order = $this->order->get($orderId);
        if(!$order)
        {
            show_error($this->lang->line('no_data_exist'),500);
        }
        if($order->user_id != $user_id)
        {
            show_404();
        }
        if($order->status > 0 || $order->pay == 1 || $order->complete == 1)
        {
            show_error('您已付款或订单已处理',500);
        }
        switch (strtolower($pay_type)) {
            case 'daofu':
                if($this->order->update(array('pay_type'=>$this->pay->getType($pay_type),'complete'=>1),$orderId))
                {
                    redirect('payment/result/success');
                }
                break;
            case 'alipay':
                $this->alipay($order);
                break;
            case 'banking':
                $this->bank($order,$bank_name);
                break;
            default:
                # code...
                break;
        }

	}

    public function result($msg)
    {
        $this->auth->check_login();
        $data['msg'] = $msg;
        $this->load->view('home/pay-result',$data);
    }

    private function alipay($order)
    {
        require_once($this->alipayPath."alipay.config.php");
        require_once($this->alipayPath."lib/alipay_submit.class.php");

        /**************************请求参数**************************/

        //商户订单号
        $out_trade_no = $order->code;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = 'OrderNumber:'.$order->code;//'壹心E购, 订单号:'.$order->code;
        //必填

        //付款金额
        $total_fee = round($order->price,2);
        //必填

        //订单描述

        $body = 'OrderNumber:'.$order->code;//'壹心E购, 订单号:'.$order->code;
        //商品展示地址
        $show_url = base_url().'item/id/'.$order->id;//$_POST['WIDshow_url'];
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type"  => $this->payment_type,
                "notify_url"    => $this->notify_url,
                "return_url"    => $this->return_url,
                "seller_email"  => $this->seller_email,
                "out_trade_no"  => $out_trade_no,
                "subject"   => $subject,
                "total_fee" => $total_fee,
                "body"  => $body,
                "show_url"  => $show_url,
                //"anti_phishing_key" => $anti_phishing_key,
                //"exter_invoke_ip"   => $exter_invoke_ip,
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "submit");
        echo $html_text;

    }
    // 网银支付
    private function bank($order,$bank_name)
    {
        require_once($this->alipayPath."alipay.config.php");
        require_once($this->alipayPath."lib/alipay_submit.class.php");

        /**************************请求参数**************************/

        //商户订单号
        $out_trade_no = $order->code;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = '壹心E购, 订单号:'.$order->code;
        //必填

        //付款金额
        $total_fee = round($order->price,2);
        //必填

        //订单描述

        $body = $order->info;
        //默认支付方式
        $paymethod = "bankPay";
        //必填
        //默认网银
        $defaultbank = $bank_name ? $bank_name : 'ICBCB2C';
        //必填，银行简码请参考接口技术文档

        //商品展示地址
        $show_url = '';
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type"  => $this->payment_type,
                "notify_url"    => $this->notify_url,
                "return_url"    => $this->return_url,
                "seller_email"  => $this->seller_email,
                "out_trade_no"  => $out_trade_no,
                "subject"   => $subject,
                "total_fee" => $total_fee,
                "body"  => $body,
                "paymethod" => $paymethod,
                "defaultbank"   => $defaultbank,
                "show_url"  => $show_url,
                "anti_phishing_key" => $anti_phishing_key,
                "exter_invoke_ip"   => $exter_invoke_ip,
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
        $order->bank = $defaultbank;
        $order->save();
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }

    public function alipaynotify()
    {
        require_once($this->alipayPath."alipay.config.php");
        require_once($this->alipayPath."lib/alipay_notify.class.php");
        $this->load->model('pay_log');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号
            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];

            $order = $this->order->get_by_code($out_trade_no);

            if($trade_status == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //该种交易状态只在两种情况下出现
                //1、开通了普通即时到账，买家付款成功后。
                //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

                //调试用，写文本函数记录程序运行情况是否正常
                $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'info'=>'交易成功'));
            }
            else if ($trade_status == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

                //调试用，写文本函数记录程序运行情况是否正常
                if($order && $order->pay==0 && $order->pay_code=='' && $order->complete==0 && $order->pay_time<=0)
                {
                    $notify_time = $_POST['notify_time'];
                    $p = array(
                        'pay_type' => (isset($_POST['bank_seq_no'])&&$_POST['bank_seq_no']!='') ? $this->pay->getType('bank') : $this->pay->getType('alipay'),
                        'bank_no' => (isset($_POST['bank_seq_no'])&&$_POST['bank_seq_no']!='') ? $_POST['bank_seq_no'] : '',
                        'buyer_email' => $_POST['buyer_email'],
                        'pay' => 1,
                        'notify_time' => $notify_time,
                        'pay_time' => local_to_gmt(),
                        'pay_code' => $trade_no,
                        'complete' => 1
                    );
                    if($this->order->update($p,$order->id))
                    {
                        $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'info'=>'支付成功，支付时间:'.$notify_time));
                    }                    
                }
            }
            else
            {
                $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'status'=>2,'info'=>'支付失败'));
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";     //请不要修改或删除
        }
        else {
            //验证失败
            $this->pay_log->insert(array('order_id'=>0,'order_code'=>$_POST['out_trade_no'],'from'=>'alipay','trade_no'=>$_POST['trade_no'],'status'=>2,'info'=>'验证失败'));
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    public function alipayreturn()
    {
        require_once($this->alipayPath."alipay.config.php");
        require_once($this->alipayPath."lib/alipay_notify.class.php");
        $this->load->model('pay_log');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            //$trade_status = $_GET['trade_status'];

            $order = $this->order->get_by_code($out_trade_no);

            if($_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                if($order && $order->pay==0 && $order->pay_code=='' && $order->complete==0 && $order->pay_time<=0)
                {
                    $notify_time = $_GET['notify_time'];
                    $p = array(
                        'pay_type' => (isset($_GET['bank_seq_no'])&&$_GET['bank_seq_no']!='') ? $this->pay->getType('bank') : $this->pay->getType('alipay'),
                        'bank_no' => (isset($_GET['bank_seq_no'])&&$_GET['bank_seq_no']!='') ? $_GET['bank_seq_no'] : '',
                        'buyer_email' => $_GET['buyer_email'],
                        'pay' => 1,
                        'notify_time' => $notify_time,
                        'pay_time' => local_to_gmt(strtotime($notify_time)),
                        'pay_code' => $trade_no,
                        'complete' => 1
                    );
                    if($this->order->update($p,$order->id))
                    {
                        $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'info'=>'支付成功，支付时间:'.$notify_time));
                    }
                }
            }
            else if($_GET['trade_status'] == 'TRADE_FINISHED')
            {
                $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'info'=>'交易成功'));
            }
            else {
                $this->pay_log->insert(array('order_id'=>$order->id,'order_code'=>$out_trade_no,'from'=>'alipay','trade_no'=>$trade_no,'status'=>2,'info'=>'交易失败'));
                redirect(base_url().'payment/result/failed');
            }
            redirect(base_url().'payment/result/success');
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            $this->pay_log->insert(array('order_id'=>0,'order_code'=>$_GET['out_trade_no'],'from'=>'alipay','trade_no'=>$_GET['trade_no'],'status'=>2,'info'=>'验证失败'));
            redirect(base_url().'payment/result/failed');
        }
    }
}