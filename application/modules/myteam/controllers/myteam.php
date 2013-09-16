<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Myteam extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_layout = 'admin';
        $this->load->Model('myteammodel');
        $this->_data['moduleTitle'] = 'Người Dùng';
    }

    function index() {
        $this->_layout = NULL;
        $this->_data['pageTitle'] = 'List User';
        $this->_data['page'] = 'index';
        $this->_contentData['listUser'] = $this->myteammodel->getListUserInfo();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}
?>
