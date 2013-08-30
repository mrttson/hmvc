<?php
require_once(APPPATH . 'controllers/CommonController.php');
class Usercp extends CommonController {
    public $contentData = array();
    public function __construct() {
        parent::__construct();
        $this->contentData['moduleTitle'] = 'Bộ Sưu Tập';
        $this->_layout = 'admin';
    }
    
    
    function index() {
        
    }

}

?>
