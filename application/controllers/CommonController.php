<?php

class CommonController extends MX_Controller {

    public $_layout = null;
    public $_data = array();
    public $_userInfo = array();

    public function __construct() {
        parent::__construct();
        //Load Model
        $this->load->Model('CommonModel');
        //Load Library
        $this->load->library('session');
        //Load Helper
        $this->load->helper('url');

        //User info
        //Prepairing Layout
        $this->_data['sideBar'] = $this->getAdminSideBar();
        $this->_data['header'] = '';
        $this->_data['search'] = '';
        $this->_data['topNav'] = '';
        $this->_data['quickNav'] = '';
        $this->_data['footer'] = $this->getFooter();
    }

    function loadPage() {
        if ($this->_layout != NULL) {
            return $this->load->view('layouts/' . $this->_layout . '/layout', $this->_data);
        } else {
            $module = $this->router->fetch_module();
            $controller = $this->router->fetch_class();
            $action = $this->router->fetch_method();
            return $this->load->view($controller . '/' . $action, $this->_data);
        }
    }

    function log($message) {
        return log_message('error',$message);
    }

    function getUserInfo() {
        
    }

    function checkpermisson() {
        if (!isset($_SESSION['user_id'])) {
            $this->session->sess_destroy();
            redirect('user/login');
        }
    }

    function getAdminSideBar() {
        return $this->CommonModel->getAdminSideBarData();
    }

    function getFooter() {
        return $this->CommonModel->getFooterData();
    }

}

?>
