<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Systemmenu extends CommonController {

    public $contentData = array();

    public function __construct() {
        parent::__construct();
        $this->contentData['moduleTitle'] = 'System Menu';
        $this->_layout = 'admin';
    }

    function index() {
        $this->_data['pageTitle'] = 'ADMIN';
        $this->_data['page'] = 'index';
        $this->contentData['data'] = 'ADMIN PAGE';
        $this->_data['content'] = $this->contentData;
        $this->loadPage();
    }

}

?>
