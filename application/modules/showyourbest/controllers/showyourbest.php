<?php

require_once(APPPATH . 'controllers/CommonController.php');

class ShowYourBest extends CommonController {

    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = NULL;
        $this->_contentData['moduleTitle'] = '';
    }

    function index($catId = NULL) {
        $this->_data['pageTitle'] = '';
        $this->_data['page'] = 'index';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}

?>
