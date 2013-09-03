<?php

require_once(APPPATH . 'controllers/CommonController.php');

class AdminController extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->checkPermisson();
        $this->_contentData['moduleTitle'] = 'Bộ Sưu Tập';
        $this->_layout = 'admin';
    }

    function index() {
        $this->_data['pageTitle'] = 'ADMIN';
        $this->_data['page'] = 'admin_view';
        $this->_contentData['data'] = 'ADMIN PAGE';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}

?>
