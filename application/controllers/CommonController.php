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
    public $_paginationConfig = array();

    public function __construct() {
        parent::__construct();
        //Load Model
        $this->load->model('commonmodel');
        //Load Library
        $this->load->library('session');
        $this->load->library('pagination');
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

        //Prepairing Default Pagination
        $this->_paginationConfig["per_page"] = 10;
        $this->_paginationConfig["uri_segment"] = 2;
        $this->_paginationConfig['use_page_numbers'] = TRUE;
        $this->_paginationConfig['first_tag_open'] = $_paginationConfig['last_tag_open'] = $_paginationConfig['next_tag_open'] = $_paginationConfig['prev_tag_open'] = $_paginationConfig['num_tag_open'] = '';
        $this->_paginationConfig['first_tag_close'] = $_paginationConfig['last_tag_close'] = $_paginationConfig['next_tag_close'] = $_paginationConfig['prev_tag_close'] = $_paginationConfig['num_tag_close'] = '';
        $this->_paginationConfig['cur_tag_open'] = '<a href="javascript:;" class="selected">';
        $this->_paginationConfig['cur_tag_close'] = '</a>';
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
            if ($imgInfo["size"] < 10000000) {
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
                return;
                NULL;
            }
        } else {
            return NULL;
        }
    }

    function uploadMultiImg($albumInfo) {
        $arrImgName = array();
        foreach ($albumInfo["images"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $name = $albumInfo["images"]["name"][$key];
                $fileName = $_SERVER['REQUEST_TIME'] . '_' . $albumInfo['images']['name'][$key];
                move_uploaded_file($albumInfo["images"]["tmp_name"][$key], UPLOAD_FILE_PATH . $fileName);
                $arrImgName[] = $fileName;
            }
        }
        return $arrImgName;
    }

}

?>
