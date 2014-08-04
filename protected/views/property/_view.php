<?php
/* @var $this PropertyController */
/* @var $data Property */
?>

<div class="item">

    <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->address), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('purpose_id')); ?>:</b>
    <?php echo CHtml::encode(Purposes::model()->find('id=:purpose_id',array(':purpose_id'=>$data->purpose_id))->name); ?>
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
        echo CHtml::encode('Недвижимость');
    else
        echo CHtml::encode('ЗУ');
    ?>
    <br />
    <p>Фото</p>
    <div class="image-row">
        
  
            <?php
            echo Chtml::link(CHtml::image('/images/nedv1.jpg', 'Изображение недоступно!', array('class' => 'example-image',)), '/images/nedv1.jpg', array(
                'data-lightbox' => 'pic' . $data->id,
                'data-title' => 'image_' . $data->id,
            ));
            ?>
           
            <?php
            echo Chtml::link(CHtml::image('/images/banner1.jpg', 'Изображение недоступно!', array('class' => 'example-image',)), '/images/banner1.jpg', array(
                'data-lightbox' => 'pic' . $data->id,
                'data-title' => 'image_' . $data->id,
            ));
            ?>

    </div>
</div>