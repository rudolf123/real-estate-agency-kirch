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
    ?>
    <fieldset class="contentborder">
        <fieldset class="searchcondition">
            <p>Тип объекта</p>
            <?php echo CHtml::checkBoxList('types[]', '', array('0' => 'Недвижимость', '1' => 'ЗУ')) ?>
        </fieldset>
        <fieldset id="searchpurposes" class="searchcondition">
            <p>Назначение объекта</p>
            <?php echo CHtml::checkBoxList('purposes[]', '', CHtml::listData(Purposes::model()->findAll(), 'name', 'name'), array('labelOptions' => array('style' => 'display:inline')))
            ?>
        </fieldset>
        <fieldset class="searchcondition">
            <p>Площадь объекта</p>
            <?php echo CHtml::dropDownList('areaID', '', array('' => '', '0' => '15-30', '1' => '30-50', '2' => '50-150', '3' => '150-500', '4' => 'свыше 500')) ?>
            <?php
            echo CHtml::dropDownList('areaID', '', array('' => '', '0' => '2-15 сот.', '1' => '15-50 сот.', '2' => '1-5 га',
                '3' => '5-10 га', '4' => '10-20 га', '5' => 'больше 20 га', '6' => 'больше 1000 га'))
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