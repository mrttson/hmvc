<?php

require_once(APPPATH . 'controllers/CommonController.php');

class User extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_layout = 'admin';
        $this->load->Model('usermodel');
        $this->_data['moduleTitle'] = 'Người Dùng';
    }

    function index() {
        //Layout
        $this->_layout = 'admin';
        $this->_data['pageTitle'] = 'List User';
        $this->_data['page'] = 'index';
        
        //Pagination
        $this->_paginationConfig["base_url"] = base_url() . "user";
        $this->_paginationConfig["total_rows"] = $this->usermodel->getCountAll();
        $this->pagination->initialize($this->_paginationConfig);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
        $this->_contentData["links"] = $this->pagination->create_links();
        $start = ($page-1)*$this->_paginationConfig["per_page"];
        $limit = $this->_paginationConfig["per_page"];

        //Data
        $this->_contentData['listUser'] = $this->usermodel->getListUserInfo($start, $limit);
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function login() {
        if (!isset($_POST['username']) && !isset($_POST['password'])) {//Check if user not login
            $this->_layout = NULL;
            $this->_data['pageTitle'] = "Login Page";
            $this->_data['page'] = 'login.php';
            $this->_data['content'] = NULL;
            if (isset($_SESSION['useri_id'])) {
                redirect('user/index');
            } else {
                $this->loadPage();
            }
        } else {//When user Login
            $username = $_POST['username'];
            $password = $_POST['password'];
            $res = $this->usermodel->getUserInfo(NULL, $username, $password);
            if ($res) {
                if (mysql_num_rows($res) > 0) {
                    //Set user info to session
                    $_SESSION['user_id'] = $res['id'];
                    $_SESSION['user_role'] = $res['role'];
                    redirect(site_url('index'));
                } else {
                    redirect('login');
                }
            }
        }
    }

    function register() {
        if (!isset($_POST) || empty($_POST)) {
            $this->_layout = NULL;
            $this->_data['pageTitle'] = "Register User";
            $this->_data['page'] = 'register';
            //$this->_data['content'] = "<h1>Register User</h1>";
            $this->loadPage();
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];

            $sql = "INSERT INTO USERS(username,password,email,fullname)
                VALUES('" . $username . "', '" . md5($password) . "', '" . $email . "', '" . $fullname . "')";
            if ($this->usermodel->Execute($sql)) {
                $id = $this->usermodel->getIdMax();
                redirect(site_url('user/index/' . $id));
            } else {
                redirect(site_url('user/login'));
            }
        }
    }

    function logout() {
        if (isset($_SESSION)) {
            session_destroy();
        }
        redirect(site_url('user/login'));
    }

    function add() {
        if (!isset($_POST) || empty($_POST)) {
            $this->_layout = 'admin';
            $this->_data['pageTitle'] = 'Add User';
            $this->_data['page'] = 'add';
            $this->_contentData['listRole'] = $this->usermodel->getListRole();
            $this->_data['content'] = $this->_contentData;
            $this->loadPage();
        } else {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['fullname'] = $_POST['fullname'];
            $data['email'] = $_POST['email'];
            $data['role'] = $_POST['role'];
            if ($this->usermodel->add($data)) {
                redirect(site_url('user/list'));
            } else {
                redirect(site_url('user/add'));
            }
        }
    }

    function edit($id = NULL) {
        if (!empty($id)) {
            if (!isset($_POST) || empty($_POST)) {
                $this->_data['pageTitle'] = 'Edit User';
                $this->_data['page'] = 'edit';
                $this->_contentData['userInfo'] = $this->usermodel->getUserInfoById($id);
                $this->_contentData['listRole'] = $this->usermodel->getListRole();
                $this->_data['content'] = $this->_contentData;
                $this->loadPage();
            } else {
                //update User Info
                $data['fullname'] = $_POST['fullname'];
                $data['email'] = $_POST['email'];
                $data['role'] = $_POST['role'];
                $data['id'] = $id;
                if ($this->usermodel->update($data)) {
                    redirect(site_url('user/index'));
                } else {
                    echo 'Die when Edit User';
                }
            }
        } else {
            redirect(site_url('user/index'));
        }
    }

    function delete($id = NULL) {
        if (!empty($id)) {
            if ($this->usermodel->delete($id)) {
                redirect('user');
            } else {
                echo 'Error SQL [DELETE user]';
            }
        } else {
            echo 'Empty Id [delete user]';
        }
    }

    function userCp($id = NULL) {
        if (!empty($id)) {
            if (!isset($_POST) || empty($_POST)) {
                $this->_data['pageTitle'] = 'UserCP';
                $this->_data['page'] = 'usercp';
                $this->_contentData['userInfo'] = $this->usermodel->getUserInfoById($id);
                $this->_data['content'] = $this->_contentData;
                $this->loadPage();
            } else {
                //update User Info
                $data['fullname'] = $_POST['fullname'];
                $data['email'] = $_POST['email'];
                $data['role'] = $_POST['role'];
                $data['id'] = $id;
                if ($this->usermodel->update($data)) {
                    redirect(site_url('user/index'));
                } else {
                    echo 'Die when Edit User';
                }
            }
        } else {
            redirect(site_url('user/index'));
        }
    }

}
?>
