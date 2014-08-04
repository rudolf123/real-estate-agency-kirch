<?php
/* @var $this PropertyController */
/* @var $model Property */
/* @var $form CActiveForm */
?>

<div class="row">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'search-form',
        'action' => Yii::app()->createUrl('property/search'),
        'method' => 'get',
    ));

    $displayType1 = 'none';
    $displayType2 = 'none';
    $displayArea1 = 'none';
    $displayArea2 = 'none';
    if (isset($params['types']) && in_array('0', $params['types'])){
        $displayType1 = 'block';
        $displayArea1 = 'inline';
    }
    if (isset($params['types']) && in_array('1', $params['types'])){
        $displayType2 = 'block';
        $displayArea2 = 'inline';
    }
    ?>
    <fieldset class="contentborder">
        <fieldset class="searchcondition">
            <p>Тип объекта</p>
            <?php echo CHtml::checkBoxList('types[]', $params['types'], array('0' => 'Недвижимость', '1' => 'ЗУ')) ?>
        </fieldset>

        <fieldset id="searchpurposes1" class="searchcondition" style="display: <?php echo $displayType1 ?>">
            <p>Назначение объекта</p>
            <?php
            echo CHtml::checkBoxList('purposes_id[]', $params['purposes_id'], CHtml::listData(Purposes::model()->findAllByAttributes(
                                    array('type' => '0')), 'id', 'name'), array('labelOptions' => array('style' => 'display:inline')))
            ?>
        </fieldset>
        <fieldset id="searchpurposes2" class="searchcondition" style="display: <?php echo $displayType2 ?>">
            <p>Назначение объекта</p>
            <?php
            echo CHtml::checkBoxList('purposes_id[]', $params['purposes_id'], CHtml::listData(Purposes::model()->findAllByAttributes(
                                    array('type' => '1')), 'id', 'name'), array('labelOptions' => array('style' => 'display:inline')))
            ?>
        </fieldset>
        <fieldset id="searcharea" class="searchcondition" style="display: <?php if (isset($params['types'])) echo 'block' ?>">

            <p>Площадь объекта</p>
            <?php
            echo CHtml::dropDownList('areaID1', $params['areaID1'], array('' => '', '0' => '15-30 кв.м.', '1' => '30-50 кв.м.', '2' => '50-150 кв.м.', '3' => '150-500 кв.м.', '4' => 'свыше 500 кв.м.'), array('style' => 'display:' . $displayArea1))
            ?>

            <?php
            echo CHtml::dropDownList('areaID2', $params['areaID2'], array('' => '', '0' => '2-15 сот.', '1' => '15-50 сот.', '2' => '1-5 га',
                '3' => '5-10 га', '4' => '10-20 га', '5' => 'больше 20 га', '6' => 'больше 1000 га'), array('style' => 'display:' . $displayArea2))
            ?>

        </fieldset>
        <div>   
            <?php
            echo CHtml::submitButton('Найти!', array('class' => 'my_button_blue', 'style' => 'display:block'));
            ?>
        </div>
    </fieldset>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->