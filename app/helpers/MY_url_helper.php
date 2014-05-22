<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * getBrowser
 *
 * Fetches a language variable and optionally
 *
 * @access	public
 * @return	string
 */
function get_user_browser() {
    $CI =& get_instance();
    $sys = $CI->input->user_agent();
    if (stripos($sys, "NetCaptor") > 0) {
        $exp[0] = "NetCaptor";
        $exp[1] = "";
    } elseif (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Mozilla Firefox";
        $exp[1] = $b[1];
    } elseif (stripos($sys, "MAXTHON") > 0) {
        preg_match("/MAXTHON\s+([^;)]+)+/i", $sys, $b);
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        // $exp = $b[0]." (IE".$ie[1].")";
        $exp[0] = $b[0] . " (IE" . $ie[1] . ")";
        $exp[1] = $ie[1];
    } elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        //$exp = "Internet Explorer ".$ie[1];
        $exp[0] = "Internet Explorer";
        $exp[1] = $ie[1];
    } elseif(stripos($sys, "rv") > 0){
        preg_match("/rv.([0-9\.]+)+/i", $sys, $ie);
        $exp[0] = "Internet Explorer";
        $exp[1] = $ie[1];
    }elseif (stripos($sys, "Netscape") > 0) {
        $exp[0] = "Netscape";
        $exp[1] = "";
    } elseif (stripos($sys, "Opera") > 0) {
        $exp[0] = "Opera";
        $exp[1] = "";
    } elseif (stripos($sys, "Chrome") > 0) {
        $exp[0] = "Chrome";
        $exp[1] = "";
    } else {
        $exp[0] = "other";
        $exp[1] = "";
    }
    return $exp;
}
// ------------------------------------------------------------------------

function url_exist($url)
{
    try{
        $headeraar = get_headers($url);
        if(strpos($headeraar[0],'HTTP/1.0 1')===false 
                && strpos($headeraar[0],'HTTP/1.0 2')===false 
                && strpos($headeraar[0],'HTTP/1.0 3')===false 
                && strpos($headeraar[0],'HTTP/1.1 1')===false 
                && strpos($headeraar[0],'HTTP/1.1 2')===false 
                && strpos($headeraar[0],'HTTP/1.1 3')===false)
        {
            return false;
        }
    }catch(Exception $e){
        //执行错误处理
        return false;
    }
    return true;
}
// ------------------------------------------------------------------------

/* End of file url_helper.php */
/* Location: ./app/helpers/url_helper.php */