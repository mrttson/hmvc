<?php

require_once(APPPATH . 'controllers/CommonController.php');
class Product extends CommonController{
    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = "web_layout";//Normal layout
    }
    const user_permisson= 1;
    const admin_permisson= 1;//Lấy khi user login
    function index (){
        if (user_permisson == admin_permisson){
            $this->_layout = "admin_layout";//load admin layout
            $this->_page = "index_admin";
            $this->loadPage();
        } else {
            $this->_page = "index_user";
            $this->loadPage();
        }
    }
}
?>
