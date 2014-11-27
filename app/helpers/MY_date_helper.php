<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('gmt_to_local'))
{
    function gmt_to_local($time = '', $timezone = 'UP8', $dst = FALSE)
    {
        if ($time == '')
        {
            return now();
        }

        $time += timezones($timezone) * 3600;

        if ($dst == TRUE)
        {
            $time += 3600;
        }

        return $time;
    }
}
// ------------------------------------------------------------------------

/* End of file date_helper.php */
/* Location: ./app/helpers/date_helper.php */