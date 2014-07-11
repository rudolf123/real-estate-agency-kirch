<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login', 'registration', 'index', 'error'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user
                'actions' => array('logout',),
                'users' => array('@'),
            ),
            array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                'actions' => array('adminuserrequests', 'ajaxupdaterequeststatus','processimageupload'),
                'expression' => array('Controller', 'allowOnlyAdminModer')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->redirect(Yii::app()->createUrl("user/login"));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        $this->redirect(Yii::app()->createUrl("user/logout"));
    }

    public function actionAdminUserRequests() {
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'condition' => 'approved = 0',
            ),
        ));
        $this->render('adminUserRequests', array('dataProvider' => $dataProvider));
    }

    public function actionAjaxUpdateRequestStatus() {
        if (isset($_GET['add_uid'])) {
            $model = User::model()->findByPk($_GET['add_uid']);
            $model->approved = 1;
            $model->save();
            $this->sendEmailNotification($model->email, 'Ваша заявка была одобрена. Вы можете войти в систему под своими реквизитами');
            $dataProvider = new CActiveDataProvider('User', array(
                'criteria' => array(
                    'condition' => 'approved = 0',
                ),
            ));
        }

        if (isset($_GET['rem_uid'])) {
            $model = User::model()->findByPk($_GET['rem_uid']);
            $email = $model->email;
            $model->delete();
            $modelAdmin = User::model()->find('login=:_login', array(':_login' => 'admin'));
            $this->sendEmailNotification($email, 'Ваша заявка не одобрена. Вы можете обратиться к администратору по адресу ' . $modelAdmin->email);
            $dataProvider = new CActiveDataProvider('User', array(
                'criteria' => array(
                    'condition' => 'approved = 0',
                ),
            ));
        }
    }
    
    public function actionProcessimageupload() {
        if (isset($_POST)) {
            ############ Edit settings ##############
            $ThumbSquareSize = 200; //Thumbnail will be 200x200
            $BigImageMaxSize = 500; //Image Maximum height or width
            $ThumbPrefix = "thumb_"; //Normal thumb Prefix
            if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/tmpUploads/'))
            {
                mkdir($_SERVER['DOCUMENT_ROOT'].'/tmpUploads/', 0777);
            }
            $DestinationDirectory = $_SERVER['DOCUMENT_ROOT'].'/tmpUploads/'; //specify upload directory ends with / (slash)
            $Quality = 90; //jpeg quality
            ##########################################
            //check if this is an ajax request
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                die();
            }
            // check $_FILES['ImageFile'] not empty
            if (!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])) {
                die('Something wrong with uploaded file, something missing!'); // output error when above checks fail.
            }

            // Random number will be added after image name
            $RandomNumber = rand(0, 9999999999);

            $ImageName = str_replace(' ', '-', strtolower($_FILES['ImageFile']['name'])); //get image name
            $ImageSize = $_FILES['ImageFile']['size']; // get original image size
            $TempSrc = $_FILES['ImageFile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
            $ImageType = $_FILES['ImageFile']['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.
            //Let's check allowed $ImageType, we use PHP SWITCH statement here
            switch (strtolower($ImageType)) {
                case 'image/png':
                    //Create a new image from file 
                    $CreatedImage = imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
                    break;
                case 'image/gif':
                    $CreatedImage = imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    $CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
                    break;
                default:
                    die('Unsupported File!'); //output error and exit
            }

            //PHP getimagesize() function returns height/width from image file stored in PHP tmp folder.
            //Get first two values from image, width and height. 
            //list assign svalues to $CurWidth,$CurHeight
            list($CurWidth, $CurHeight) = getimagesize($TempSrc);

            //Get file extension from Image name, this will be added after random name
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);

            //remove extension from filename
            $ImageName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName);

            //Construct a new name with random number and extension.
            $NewImageName = $ImageName . '-' . $RandomNumber . '.' . $ImageExt;

            //set the Destination Image
            $thumb_DestRandImageName = $DestinationDirectory . $ThumbPrefix . $NewImageName; //Thumbnail name with destination directory
            $DestRandImageName = $DestinationDirectory . $NewImageName; // Image with destination directory
            //Resize image to Specified Size by calling resizeImage function.
            if ($this->resizeImage($CurWidth, $CurHeight, $BigImageMaxSize, $DestRandImageName, $CreatedImage, $Quality, $ImageType)) {
                //Create a square Thumbnail right after, this time we are using cropImage() function
                if (!$this->cropImage($CurWidth, $CurHeight, $ThumbSquareSize, $thumb_DestRandImageName, $CreatedImage, $Quality, $ImageType)) {
                    echo 'Error Creating thumbnail';
                }
                /*
                  We have succesfully resized and created thumbnail image
                  We can now output image to user's browser or store information in the database
                 */
                echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
                echo '<tr>';
                echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/tmpUploads/' . $ThumbPrefix . $NewImageName . '" alt="Thumbnail"></td>';
                echo '</tr><tr>';
                echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/tmpUploads/' . $NewImageName . '" alt="Resized Image"></td>';
                echo '</tr>';
                echo '</table>';

                /*
                  // Insert info into database table!
                  mysql_query("INSERT INTO myImageTable (ImageName, ThumbName, ImgPath)
                  VALUES ($DestRandImageName, $thumb_DestRandImageName, 'uploads/')");
                 */
            } else {
                die('Resize Error'); //output error
            }
        }
    }

    private function sendEmailNotification($email, $data) {
        $subject = 'Регистрация в системе MoocsPenzGTU';
        $msg = $data;
        $b_name = 'MoocsPenzGTU';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: " . $b_name . "\r\n";
        $mail = mail($email, $subject, $msg, $headers);
    }
    
        // This function will proportionally resize image 
    public function resizeImage($CurWidth, $CurHeight, $MaxSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
        //Check Image size is not 0
        if ($CurWidth <= 0 || $CurHeight <= 0) {
            return false;
        }

        //Construct a proportional size of new image
        $ImageScale = min($MaxSize / $CurWidth, $MaxSize / $CurHeight);
        $NewWidth = ceil($ImageScale * $CurWidth);
        $NewHeight = ceil($ImageScale * $CurHeight);
        $NewCanves = imagecreatetruecolor($NewWidth, $NewHeight);

        // Resize Image
        if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight)) {
            switch (strtolower($ImageType)) {
                case 'image/png':
                    imagepng($NewCanves, $DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves, $DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves, $DestFolder, $Quality);
                    break;
                default:
                    return false;
            }
            //Destroy image, frees memory	
            if (is_resource($NewCanves)) {
                imagedestroy($NewCanves);
            }
            return true;
        }
    }

//This function corps image to create exact square images, no matter what its original size!
    public function cropImage($CurWidth, $CurHeight, $iSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
        //Check Image size is not 0
        if ($CurWidth <= 0 || $CurHeight <= 0) {
            return false;
        }

        //abeautifulsite.net has excellent article about "Cropping an Image to Make Square bit.ly/1gTwXW9
        if ($CurWidth > $CurHeight) {
            $y_offset = 0;
            $x_offset = ($CurWidth - $CurHeight) / 2;
            $square_size = $CurWidth - ($x_offset * 2);
        } else {
            $x_offset = 0;
            $y_offset = ($CurHeight - $CurWidth) / 2;
            $square_size = $CurHeight - ($y_offset * 2);
        }

        $NewCanves = imagecreatetruecolor($iSize, $iSize);
        if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)) {
            switch (strtolower($ImageType)) {
                case 'image/png':
                    imagepng($NewCanves, $DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves, $DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves, $DestFolder, $Quality);
                    break;
                default:
                    return false;
            }
            //Destroy image, frees memory	
            if (is_resource($NewCanves)) {
                imagedestroy($NewCanves);
            }
            return true;
        }
    }

    public function log($msg) {
        $file = fopen('log.txt', 'a');
        fwrite($file, $msg);
        fclose($file);
    }

}
