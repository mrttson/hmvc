<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Myteam extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_layout = 'admin';
        $this->load->Model('myteammodel');
        $this->_data['moduleTitle'] = 'Người Dùng';
    }

    function index($mName = NULL) {
        $this->_layout = NULL;
        $this->_data['pageTitle'] = 'Member Show';
        $this->_data['page'] = 'index';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }
    
    function ajaxGetImg(){
        $req = $_POST['data'];
        $data = $this->myteammodel->getImg($req);
        if ($data){
            $data['error'] = '0';
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => '1'));
        }
    }
    
    function add($mName = NULL){
        if ($mName == NULL){
            $this->_layout='admin';
            $this->_data['pageTitle'] = 'Member List';
            $this->_data['page'] = 'add';
            $this->_data['listMemberInfo'] = $this->myteammodel->getListMemberInfo();
            $this->_data['content'] = $this->_contentData;
            $this->loadPage();
        }
    }

}
?>
