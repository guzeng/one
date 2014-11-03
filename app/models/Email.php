<?php

class Email extends Eloquent {

	protected $table = 'email';
	public $timestamps =false;
	protected $guarded = array('id');

    static public $to;
    static public $subject;
    static public $msg;
    static public $username;
    static public $cc;

    static public function asyn($mails=array())
    {
        if(is_array($mails) && !empty($mails))
        {
            if(isset($mails[0]) && (is_array($mails[0]) || is_object($mails[0])))// 二维数组
            {
                foreach ($mails as $key => $value) 
                {
                    self::logNotSend($value);
                }
            }
            else
            {
                self::logNotSend($mails);
            }    
        }
        $obj    = new AsynHandle();
        $host = str_replace($_SERVER['HTTP_HOST'], '127.0.0.1:'.$_SERVER['SERVER_PORT'], asset('sendmail'));
        $obj->Request($host,array(),array(1));
    }
    /**
     * send
     *
     * @param string subject 
     * @param string msg (mail's body)
     * @param string to (who you want to send)
     * @param string username (user's name who you want to send)
     * @param string cc (who you want to Cc)
     * @author varson
     */
    static public function send($subject, $msg, $to, $cc='', $username='')
    {
        if(!$msg || !$to)
        {
            return false;
        }
        if(!Cache::has('smtp_server') || Cache::get('smtp_server')=='' || !Cache::has('smtp_user') || Cache::get('smtp_user')=='' || !Cache::has('smtp_pwd') || Cache::get('smtp_pwd')=='')
        {
            return false;
        }
        try{
            self::$to = $to;
            self::$subject = $subject;
            self::$username = $username;
            self::$cc = $cc;
            self::$msg = $msg;
            Config::set('mail.host',Cache::get('smtp_server'));// 
            Config::set('mail.port', Cache::get('smtp_port',25));
            Config::set('mail.username', Cache::get('smtp_user'));
            Config::set('mail.password', Cache::get('smtp_pwd'));

            $a = Mail::send($msg, array(), function($m)
            {
                $m->from(Cache::get('smtp_email'), Lang::get('text.LMS'));
                $m->to(Email::$to, Email::$username)->subject(Email::$subject);
                if(Email::$cc!='')
                {
                    $m->cc(Email::$cc);
                }
            });
        }catch(Exception $e){
            self::logNotSend();
            Log::error('Send email to '.$to.' failed',array('subject'=>$subject,'content'=>$msg));
            Log::error($e->getMessage());
        }

    }
    //---------------------------------------------------------------------
    /**
     * resend email
     *
     * @author varson
     * @2013/4/19
     */
    static public function sendfromDB()
    {
        if(!Cache::has('smtp_server') || Cache::get('smtp_server')=='' || !Cache::has('smtp_user') || Cache::get('smtp_user')=='' || !Cache::has('smtp_pwd') || Cache::get('smtp_pwd')=='')
        {
            return false;
        }
        DB::query('LOCK TABLES '.Config::get('database.connections.mysql.prefix').'email WRITE');
        $map = Email::all();//DB::table('email')->all();
        if(!empty($map))
        {
            Config::set('mail.host', Cache::get('smtp_server'));
            Config::set('mail.port', Cache::get('smtp_port',25));
            Config::set('mail.username', Cache::get('smtp_user'));
            Config::set('mail.password', Cache::get('smtp_pwd'));

            foreach($map as $key => $msg)
            {
                $is_locked = true;// 进行共享锁定，并且不允许该操作被阻塞
                // 若上面的锁定成功(即该文件没有被其它程序锁定，开始发送邮件)
                if ($is_locked ) 
                {    
                    try{
                        self::$to = $msg->to;
                        self::$subject = $msg->subject;
                        self::$username = $msg->username;
                        self::$cc = $msg->cc;
                        Mail::send($msg->msg, array(), function($m)
                        {
                            $m->from(Cache::get('smtp_email'), Lang::get('text.LMS'));
                            $m->to(Email::$to,Email::$username)->subject(Email::$subject);
                            if(Email::$cc!='')
                            {
                                $m->cc(Email::$cc);
                            }
                        });
                        Email::where('id',$msg->id)->delete();
                    }
                    catch(Exception $e)
                    {
                        Log::error('send email failed----'.Email::$to.'----------'.$e->getMessage());
                        
                    }
                } 
                else 
                {
                    continue;
                }
            }
        }
        DB::query('UNLOCK TABLES');
    }
    //---------------------------------------------------------------------

    static public function logNotSend($mail=array())
    {
        if(empty($mail))
        {
            $mail['to'] = self::$to;
            $mail['username'] = self::$username;
            $mail['cc'] = self::$cc;
            $mail['subject'] = self::$subject;
            $mail['msg'] = self::$msg;
        }
        $msg = isset($mail['msg']) ? $mail['msg'] : '';
        if($msg == '' && isset($mail['templete']) && (is_array($mail['templete']) || is_object($mail['templete'])))
        {
            $d = (array)$mail['templete'];
            if(isset($d['view']))
            {
                $msg = View::make($d['view'], $d)->render();
            }                    
        }
        $mail['msg'] = $msg;
        unset($mail['templete']);
        DB::table('email')->insert($mail);
        return TRUE;
    }


}