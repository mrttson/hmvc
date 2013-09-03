<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Systemmenu extends CommonController {


    public function __construct() {
        parent::__construct();
        $this->_contentData['moduleTitle'] = 'System Menu';
        $this->_layout = 'admin';
    }

    function index() {
        $this->_data['pageTitle'] = 'ADMIN';
        $this->_data['page'] = 'index';
        $this->_contentData['data'] = 'ADMIN PAGE';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}

?>
