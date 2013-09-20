<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Test extends CommonController {

    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = "admin"; //Normal layout
        $this->_contentData['moduleTitle'] = 'TEST';
    }

    function index() {
        $this->_data['pageTitle'] = 'Danh Sách Sản Phẩm';
        $this->_data['page'] = 'index';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }
}

?>
