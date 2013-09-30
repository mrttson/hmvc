<?php

require_once(APPPATH . 'controllers/CommonController.php');

class SanPham extends CommonController {

    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = "mypham"; //Normal layout
        $this->_contentData['moduleTitle'] = '';
        $this->load->Model('sanphammodel');
    }

    function index($catId = NULL) {
        $this->_data['pageTitle'] = 'Sản Phẩm';
        $this->_data['page'] = 'index';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}

?>
