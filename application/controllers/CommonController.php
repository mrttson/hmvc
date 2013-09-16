<?php

ob_start();
if (!isset($_SESSION)) {
    session_start();
}
//Define Roles
define('ADMIN_ROLE', '1');
define('SUPER_USER_ROLES', '2');
define('USER_ROLE', '3');
define('UPLOAD_FILE_PATH', 'public/images/');
define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hmvc/');

class CommonController extends MX_Controller {

    public $_layout = null;
    public $_data = array();
    public $_userInfo = array();
    public $_contentData = array();

    public function __construct() {
        parent::__construct();
        //Load Model
        $this->load->model('commonmodel');
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
        return log_message('error', $message);
    }

    function getUserInfo() {
        
    }

    function checkPermisson() {
        if (!isset($_SESSION['user_id'])) {
            $this->session->sess_destroy();
            redirect('user/login');
        }
    }

    function getAdminSideBar() {
        return $this->commonmodel->getAdminSideBarData();
    }

    function getFooter() {
        return $this->commonmodel->getFooterData();
    }

    function uploadImg($imgInfo) {
        if ($imgInfo['size'] != 0) {
            $temp = explode(".", $imgInfo["name"]);
            $extension = end($temp);
            if ($imgInfo["size"] < 5000000) {
                if ($imgInfo["error"] > 0) {
                    return FALSE;
                } else {
                    if (!file_exists(base_url() . 'public/images')) {
                        mkdir(base_url() . 'public/images', 0777, true);
                    }
                    $fileName = $_SERVER['REQUEST_TIME'] . '_' . $imgInfo['name'];
                    move_uploaded_file($imgInfo["tmp_name"], UPLOAD_FILE_PATH . $fileName);
                    return $fileName;
                }
            } else {
                echo 'Error Size Image upload >5MB';
                sleep(5);
                echo FALSE;
            }
        } else {
            return NULL;
        }
    }

}

?>
