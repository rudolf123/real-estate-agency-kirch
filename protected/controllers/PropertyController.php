<?php

class PropertyController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view', 'admin'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'update', 'delete', 'create'),
                'users' => array('administrator'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'view', 'update', 'delete', 'import', 'export', 'create', 'search'),
                'expression' => array('Controller', 'allowOnlyAdminModer')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
        if (isset($_POST['ajax_purposes'])) {
            $purposes = Purposes::model()->findAllByAttributes(
                    array('type' => $_POST['ajax_purposes']));
            $count_purposes = count($purposes);
            if ($count_purposes > 0) {
                $arr_purposes = array();
                foreach ($purposes as $purpose) {
                    $arr_purposes[$purpose->id] = $purpose->name;
                }
            }

            echo json_encode($arr_purposes);

            Yii::app()->end();
        }

        $model = new Property;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'msform') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Property'])) {
            $model->attributes = $_POST['Property'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['ajax_purposes'])) {
            $purposes = Purposes::model()->findAllByAttributes(
                    array('type' => $_POST['ajax_purposes']));
            $count_purposes = count($purposes);
            if ($count_purposes > 0) {
                $arr_purposes = array();
                foreach ($purposes as $purpose) {
                    $arr_purposes[$purpose->id] = $purpose->name;
                }
            }

            echo json_encode($arr_purposes);

            Yii::app()->end();
        }
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Property'])) {
            $model->attributes = $_POST['Property'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Property');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Property('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Property']))
            $model->attributes = $_GET['Property'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    private function decodesearchcondition($param, $id, $criteria) {
        if ($param === 'areaID1') {
            if ($id === '0') {
                $criteria->addBetweenCondition('area', '15', '30', 'AND');
            }
            if ($id === '1') {
                $criteria->addBetweenCondition('area', '30', '50', 'AND');
            }
            if ($id === '2') {
                $criteria->addBetweenCondition('area', '50', '150', 'AND');
            }
            if ($id === '3') {
                $criteria->addBetweenCondition('area', '150', '500', 'AND');
            }
            if ($id === '4') {
                $criteria->addBetweenCondition('area', '500', '999999999', 'AND');
            }
        }
        if ($param === 'areaID2') {
            if ($id === '0') {
                $criteria->addBetweenCondition('area', '200', '1500', 'AND');
            }
            if ($id === '1') {
                $criteria->addBetweenCondition('area', '1500', '5000', 'AND');
            }
            if ($id === '2') {
                $criteria->addBetweenCondition('area', '10000', '50000', 'AND');
            }
            if ($id === '3') {
                $criteria->addBetweenCondition('area', '50000', '100000', 'AND');
            }
            if ($id === '4') {
                $criteria->addBetweenCondition('area', '100000', '200000', 'AND');
            }
            if ($id === '5') {
                $criteria->addBetweenCondition('area', '100000', '200000', 'AND');
            }
            if ($id === '6') {
                $criteria->addBetweenCondition('area', '100000', '200000', 'AND');
            }
        }

        return $criteria;
    }

    public function actionSearch() {

        if (isset($_POST['ajax_purposes'])) {
            echo "<p>Назначение объекта</p>";
            echo CHtml::checkBoxList('purposes_id[]', '', CHtml::listData(Purposes::model()->findAllByAttributes(
                                    array('type' => $_POST['ajax_purposes'])), 'id', 'name'), array('labelOptions' => array('style' => 'display:inline')));
            Yii::app()->end();
        }

        $criteria = new CDbCriteria();
        if (isset($_GET['types']))
            $criteria->addInCondition('type', $_GET['types'], 'AND');
        if (isset($_GET['purposes_id']))
            $criteria->addInCondition('purpose_id', $_GET['purposes_id'], 'AND');
        if (isset($_GET['areaID1'])) {
            $criteria = $this->decodesearchcondition('areaID1', $_GET['areaID1'], $criteria);
        }
        if (isset($_GET['areaID2'])) {
            $criteria = $this->decodesearchcondition('areaID2', $_GET['areaID2'], $criteria);
        }
        if (isset($_GET['types'])) {
            $query = new CActiveDataProvider('Property', array(
                'criteria' => $criteria));
            $this->render('search', array(
                'model' => $query,
                'params' => $_GET,
            ));
        } else {
            $this->render('search', array());
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Property the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Property::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Property $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'property-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
