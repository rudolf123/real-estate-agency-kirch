<h1>Недвижимость и ЗУ</h1>

<div class="buttons"> 
    <?php echo CHtml::link("Просмотр таблицей", CHtml::normalizeUrl('admin'),array('class'=>'my_button')) ?> 
    <?php echo CHtml::link("Новая запись", CHtml::normalizeUrl('create'), array('class'=>'my_button')) ?>
</div>
<div class="contentborder">
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
</div>