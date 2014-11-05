<?php
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */

require_once(CLASS_PATH."Recorder.class.php");
require_once(CLASS_PATH."URL.class.php");
require_once(CLASS_PATH."ErrorCase.class.php");

class Oauth{

    const VERSION = "2.0";
    const GET_AUTH_CODE_URL = "https://open.weixin.qq.com/connect/qrconnect";
    const GET_ACCESS_TOKEN_URL = "https://api.weixin.qq.com/sns/oauth2/access_token";
    const REFRESH_TOKEN = "https://api.weixin.qq.com/sns/oauth2/refresh_token";
    //const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";

    protected $recorder;
    public $urlUtils;
    protected $error;
    

    function __construct(){
        $this->recorder = new Recorder();
        $this->urlUtils = new URL();
        $this->error = new ErrorCase();
    }

    public function login(){
        $appid = $this->recorder->readInc("appid");
        $callback = $this->recorder->readInc("callback");
        //$scope = $this->recorder->readInc("scope");

        //-------生成唯一随机串防CSRF攻击
        $state = md5(uniqid(rand(), TRUE));
        $this->recorder->write('state',$state);
        //-------构造请求参数列表
        $keysArr = array(
            "response_type" => "code",
            "appid" => $appid,
            "redirect_uri" => $callback,
            "state" => $state,
            "scope" => 'snsapi_login'
        );
        $login_url =  $this->urlUtils->combineURL(self::GET_AUTH_CODE_URL, $keysArr);
        header("Location:$login_url");
    }

    public function callback(){
        $state = $this->recorder->read("state");
/*
echo $state;
print_r($_SESSION);
echo '<br>state:';
//echo $_SESSION['wxstate'];
echo '.<br>';
print_r($_GET);
        print_r($_SESSION);exit;*/
        //--------验证state防止CSRF攻击
        if($_GET['state'] != $state){
            $this->error->showError("30001");
        }

        //-------请求参数列表
        $keysArr = array(
            "appid" => $this->recorder->readInc("appid"),
            "secret" => $this->recorder->readInc("appkey"),
            "code" => $_GET['code'],
            "grant_type" => "authorization_code"
        );

        //------构造请求access_token的url
        $token_url = $this->urlUtils->combineURL(self::GET_ACCESS_TOKEN_URL, $keysArr);
        $response = $this->urlUtils->get_contents($token_url);
//print_r($response);
        /*
        正确的返回：
        {
        "access_token":"ACCESS_TOKEN",
        "expires_in":7200,
        "refresh_token":"REFRESH_TOKEN",
        "openid":"OPENID",
        "scope":"SCOPE"
        } 
        错误返回样例：
        {
        "errcode":40029,"errmsg":"invalid code"
        } 
        */
        $params = json_decode($response);

        if(isset($params->errcode)){
            $this->error->showError($params->errcode, $params->errmsg);
        }

        //$params = array();
        //parse_str($response, $params);
        $params = (array)$params;
        print_r($params);

        $this->recorder->write("access_token", $params["access_token"]);
        $this->recorder->write("openid", $params["openid"]);
        return $params;

    }

    public function refresh_token($refresh_token){

        //-------请求参数列表
        $keysArr = array(
            "appid" => $this->recorder->readInc("appid"),
            "grant_type" => "refresh_token",
            "refresh_token" => $refresh_token
        );

        $graph_url = $this->urlUtils->combineURL(self::REFRESH_TOKEN, $keysArr);
        $response = $this->urlUtils->get_contents($graph_url);
        /*
            //正确返回
            {
            "access_token":"ACCESS_TOKEN",
            "expires_in":7200,
            "refresh_token":"REFRESH_TOKEN",
            "openid":"OPENID",
            "scope":"SCOPE"
            } 
            //错误返回样例：
            {
            "errcode":40030,"errmsg":"invalid refresh_token"
            } 
        */
        $token = json_decode($response);
        if(isset($token->errcode)){
            $this->error->showError($token->errcode, $token->errmsg);
        }

        //------记录openid
        $this->recorder->write("access_token", $token->access_token);
        return $token;

    }
}
