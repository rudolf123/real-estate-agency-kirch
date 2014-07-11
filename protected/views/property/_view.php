<?php
/* @var $this PropertyController */
/* @var $data Property */
?>

<div class="item">

    <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->address), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
    <?php echo CHtml::encode($data->purpose); ?>
    <br />



    <b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
    <?php echo CHtml::encode($data->area); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php
    if ($data->type === '0')
        echo CHtml::
        encode('Недвижимость');
    else
        echo CHtml::encode('ЗУ');
    ?>
    <br />
    <div style=" width:100%; height:1px; clear:both;"></div>
        <div class="photoline"> <?php echo CHtml::image('/images/banner1.jpg','', array("width"=>"50px" ,"height"=>"50px")); ?></div>
        <div class="photoline"> <?php echo CHtml::image('/images/nedv1.jpg','', array("width"=>"50px" ,"height"=>"50px")); ?></div>
    <div style=" width:100%; height:1px; clear:both;"></div>
</div>