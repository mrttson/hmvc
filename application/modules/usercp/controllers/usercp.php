<?php
require_once(APPPATH . 'controllers/CommonController.php');
class Usercp extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_data['moduleTitle'] = 'Tài Khoản';
        $this->_layout = 'admin';
    }
    
    
    function index($id) {
        $this->_data['pageTitle'] = 'User Account';
        $this->_data['page'] = 'index';
        $_contentData['listUser'] = $this->UserModel->getListUserInfo();
        $this->_data['content'] = $_contentData;
        $this->loadPage();
    }

}

?>
