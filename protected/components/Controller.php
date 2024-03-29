<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    public $my_returnUrl;

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    protected static function allowOnlyAdmin() {
        if (Yii::app()->user->isAdmin) {
            return true;
        }
    }

    protected static function allowOnlyAdminModer() {
        if (Yii::app()->user->isAdmin || Yii::app()->user->isModer) {
            return true;
        }
    }

    protected static function allowOnlyOwner() {
        if (Yii::app()->user->isAdmin || Yii::app()->user->isModer) {
            return true;
        } else {
            $model = Request::model()->findByPk($_GET["id"]);

            if (!$model)
                return false;

            return $model->creator_id === Yii::app()->user->id;
        }
    }

    protected function logger($string) {
        $file = fopen('log.txt', 'a');
        fwrite($file, $string);
        fclose($file);
    }

}
