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

    function createThumb($imgPath) {
        $imgDetails = getimagesize($imgPath);
        
        $width = $imgDetails[0];
        $height = $imgDetails[1];
        $imgType = $imgDetails[2];
        
        $twidth = intval($width / 4);
        $this->log('TWIDTH: '. $twidth);
        $theight = intval($height / 4);
        $this->log('THEIGHT: '. $theight);
        if ($width > $height) {
            $new_width = $twidth;
            $new_height = intval($height * $new_width / $width);
        } else {
            $new_height = $theight;
            $new_width = intval($width * $new_height / $height);
        }
        $dest_x = intval(($twidth - $new_width) / 2);
        $dest_y = intval(($theight - $new_height) / 2);
        if ($imgType == IMAGETYPE_GIF) {
            $imgSaveType = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        } else if ($imgType == IMAGETYPE_JPEG) {
            $imgSaveType = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        } else if ($imgType == IMAGETYPE_PNG) {
            $imgSaveType = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgSaveType) {
            $thumbName = 'thumb_' . basename($imgPath);
            $thumbfolderPath = UPLOAD_FILE_PATH . 'thumb_images/';
            $thumbPath = $thumbfolderPath . $thumbName;
            $image = $imgcreatefrom($imgPath);
            $thumb = imagecreatetruecolor($twidth, $theight);
            imagecopyresized($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $imgSaveType($thumb, $thumbPath);
        }
    }

    //Upload 1 image
    /**
     * $folder: path to folder start from public/images/
     * $twidth: thumbnail width
     * $theight: thumbnail height
     * */
    function uploadImg($imgInfo, $folder = NULL, $twidth = NULL, $theight = NULL) {
        $data = array();
        $folderPath = NULL;
        if ($imgInfo['size'] != 0 && $imgInfo["size"] < 10000000 && $imgInfo["error"] == 0) { //Check condition to upload
            $thumbfolderPath = UPLOAD_FILE_PATH . 'thumb_images/';
            //$this->log($thumbfolderPath);
            /* ====================Create Directory==================== */
            // Create images folder if not exist
            if (is_null($folder)) {
                if (!is_dir(UPLOAD_FILE_PATH . 'images/')) {
                    mkdir(UPLOAD_FILE_PATH . 'images/', 0777, true);
                }
                $folderPath = UPLOAD_FILE_PATH . 'images/';
            } else {
                if (!is_dir(UPLOAD_FILE_PATH . $folder)) {
                    mkdir(UPLOAD_FILE_PATH . $folder, 0777, true);
                }
                $folderPath = UPLOAD_FILE_PATH . $folder;
            }
            // Create thumb_iamges folder if not exist
            if (!is_dir($thumbfolderPath)) {
                mkdir($thumbfolderPath, 0777, true);
            }
            /* ========================================================= */


            if ($twidth == NULL || $theight == NULL) {
                /* ====================Begin upload image without thumbnail================ */
                $imageName = $_SERVER['REQUEST_TIME'] . '_' . $imgInfo['name'];
                $imagePath = $folderPath . $imageName;
                $this->log('FOLDER PATH: ' . $folderPath);
                $this->log('IMG PATH: ' . $imagePath);
                // Move file
                if (move_uploaded_file($imgInfo["tmp_name"], $imagePath)) {
                    $data['imagePath'] = $imagePath;
                    $data['thumbPath'] = '';
                    $id = $this->commonmodel->saveImg($data);
                    if ($id) {
                        $this->log('UPLOAD SUCCESS. RETURN ID: ' . $id);
                        return $id;
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
                /* ========================================================================= */
            } else {
                /* ====================Begin upload image with thumbnail==================== */
                // Path to file
                $imageName = $_SERVER['REQUEST_TIME'] . '_' . $imgInfo['name'];
                $imagePath = $folderPath . $imageName;
                $this->log('IMG PATH: ' . $imagePath);
                // Move file to $folderPath
                if (move_uploaded_file($imgInfo['tmp_name'], $imagePath)) {
                    $this->createThumb($imagePath);
                    //$this->
//                    $thumbName = $_SERVER['REQUEST_TIME'] . '_thumb_' . $imgInfo['name'];
//                    $thumbPath = $thumbfolderPath . $thumbName;
//
//                    // Load the images
//                    list($width, $height) = getimagesize($imagePath);
//                    $twidth = ($twidth > $width) ? $width : $twidth;
//                    $theight = ($theight > $height) ? $height : $theight;
//                    $thumb = imagecreatetruecolor($twidth, $theight);
//                    $image = imagecreatefromjpeg($imagePath);
//
//                    // Resize the $thumb image.
//                    imagecopyresized($thumb, $image, 0, 0, 0, 0, $twidth, $theight, $width, $height);
//
//                    // Save the Thumbnail
//                    imagejpeg($thumb, $thumbPath, 100);

                    $data['imagePath'] = $imagePath;
                    //$data['thumbPath'] = $thumbPath;
                    $id = $this->commonmodel->saveImg($data);
                    if ($id) {
                        $this->log('UPLOAD SUCCESS. RETURN ID: ' . $id);
                        return $id;
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
                /* ============================================================================ */
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
