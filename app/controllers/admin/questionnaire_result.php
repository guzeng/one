<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Questionnaire_result extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('questionnaire');
        $this->load->model('questionnaire_question');
        $this->load->model('questionnaire_option');
    }
    //-------------------------------------------------------------------------

	
}
/* End of file questionnaire_result.php */
/* Location: ./app/controllers/admin/questionnaire_result.php */