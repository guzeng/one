<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * get_file_sufix
 * 
 * 获取文件后缀名
 * @param string file name
 * 2013/11/12 11:18:07   
 *  
 */

function get_file_sufix($file_name) {
	return strtolower(strrchr($file_name,'.'));
}
//------------------------------------------------------------------------

/**
 * get_file_prefix
 * 
 * 获取文件后缀名前部分
 * @param string file name
 * 2013/11/12 11:18:07   
 *  
 */

function get_file_prefix($file_name) 
{
	$index = strripos($file_name,strrchr($file_name,'.'));
	return substr($file_name,0,$index);
}
//------------------------------------------------------------------------

/**
 * create floder
 * 
 * author varson
 * 2013/3/27 14:28:17
 */
function create_folder($path)
{
    if (!is_dir($path))
    {
      create_folder(dirname($path));
      mkdir($path, 0777);
      chmod($path, 0777);
      $filename = rtrim($path,'/').'/index.html';
      $content = "<html>
                  <head>
                  	<title>403 Forbidden</title>
                  </head>
                  <body>
                  
                  <p>Directory access is forbidden.</p>
                  
                  </body>
                  </html>";
      $handle =fopen($filename,"w");
      fwrite($handle,$content);
      fclose($handle);
    }
}
//----------------------------------------------------------------------------

/**
 * upload_dir
 * 
 * 课件所在文件夹
 * author varson
 * 2013/3/27 14:55:24
 */
function upload_dir($id)
{
    $str = str_pad($id,11,"0",STR_PAD_LEFT);
    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3).'/'.substr($str,-3);
    return $str1;
}
//----------------------------------------------------------------------------

/**
 * save upload dir
 * 
 * 上传文件保存的文件夹
 * author varson
 * 2013/4/15 14:55:24
 */
function file_save_dir($id)
{
    $str = str_pad($id,11,"0",STR_PAD_LEFT);
    $str1 = substr($str,0,2).'/'.substr($str,2,3).'/'.substr($str,5,3);
    return $str1;
}
//----------------------------------------------------------------------------
function file_save_name($id)
{
    $str = str_pad($id,11,"0",STR_PAD_LEFT);
    $str1 = substr($str,-3);
    return $str1;
}
//----------------------------------------------------------------------------

/**
 * upload dir
 * @param varchar
 * @2013/11/22
 * @varson
 */
function upload_folder($type)
{
	$CI =& get_instance();
	$CI->config->load('upload');
	$folder = $CI->config->item($type.'_folder');
	if($folder)
	{
		create_folder($folder);
		return $folder;
	}
	show_error('upload folder '.$type.' not exists, maybe not config, please check app/config/upload.php');
}
//---------------------------------------------------------------------------

/**
 * directory space
 * 
 * 目录大小
 * @param string directory
 * @return int (byte)  
 * author varson
 * 2013/3/27 15:12:35
 */
function directory_space($dirPath)
{
    $sumSize = 0;
    $handle = opendir($dirPath);
    while (false!==($FolderOrFile = readdir($handle)))
    {
        if($FolderOrFile != "." && $FolderOrFile != "..")
        {
            if(is_dir("$dirPath/$FolderOrFile"))
            {
                $sumSize += directory_space("$dirPath/$FolderOrFile");
            }
            else
            {
                $sumSize += filesize("$dirPath/$FolderOrFile");
            }
        }   
    }
    closedir($handle);
	return empty ( $sumSize ) ? 0 : $sumSize; 
}
//---------------------------------------------------------------------------
/**
 * 
 * 删除目录
 * 
 * @param string directory 
 * @author
 * 2013/3/27 16:11:00
 */
function delete_dir($path)
{
    if(is_dir($path))
    {
        $file_list= scandir($path);
        foreach ($file_list as $file)
        {
            if( $file!='.' && $file!='..')
            {
                delete_dir($path.'/'.$file);
            }
        }
        @rmdir($path);  
    }
    else if(is_file($path))
    {
        @unlink($path); 
    }
}
//---------------------------------------------------------------------------

/**
* if not exists 'mb_substr', use this
*/
if(!function_exists('mb_substr'))
{
    function mb_substr($string, $start=0, $length, $charset = 'utf-8')
    {    
        if(strlen($string) <= $length) return $string;
        $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
        $strcut = '';
        if(strtolower($charset) == 'utf-8')
        {
            $n = $tn = $noc = 0;
            while($n < strlen($string))
            {
                $t = ord($string[$n]);
                // 特别要注意这部分，utf-8是1--6位不定长表示的，这里就是如何
                // 判断utf-8是1位2位还是3位还是4、5、6位,这对其他语言的编程也有用处
                // 具体可以查看rfc3629或rfc2279
                if($t == 9 || $t == 10 || (32 <= $t && $t <= 126) || $t==140 || $t==188)
                {
                    $tn = 1; $n++; $noc++;
                }
                elseif(194 <= $t && $t <= 223)
                {
                    $tn = 2; $n += 2; $noc += 2;
                }
                elseif(224 <= $t && $t <= 239)
                {
                    $tn = 3; $n += 3; $noc += 2;
                }
                elseif(240 <= $t && $t <= 247)
                {
                    $tn = 4; $n += 4; $noc += 2;
                }
                elseif(248 <= $t && $t <= 251)
                {
                    $tn = 5; $n += 5; $noc += 2;
                }
                elseif($t == 252 || $t == 253)
                {
                    $tn = 6; $n += 6; $noc += 2;
                }
                else
                {
                    $n++;
                }
                if($noc >= $length*2)
                {
                    break;
                }
            }
            if($noc > $length*2) $n -= $tn;
     
            $strcut = substr($string, $start, $n);
        }
        else
        {
            for($i = 0; $i < $length*3; $i++)
            {
                $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
            }
        }
        $strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
        return $strcut;
    }
}
//---------------------------------------------------------------------------

if ( ! function_exists('mb_strlen'))
{
    function mb_strlen($string = '')
    {
        // 将字符串分解为单元
        preg_match_all("/./us", $string, $match);
        // 返回单元个数
        return count($match[0]);
    }
}
//---------------------------------------------------------------------------
/* End of file file_helper.php */
/* Location: ./app/helpers/file_helper.php */