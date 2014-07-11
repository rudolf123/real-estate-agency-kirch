<?php
/* @var $this PropertyController */
/* @var $model Property */

//$('.search-form form').submit(function(){
//	$('#property-grid').yiiGridView('update', {
//		data: $(this).serialize()
//	});
//	return false;
//});
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

");
?>

<h1>Недвижимость и ЗУ</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'property-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'purpose',
        'address',
        'area',
        'price',
        array(
            'name' => 'type',
            'value' => '($data->type==0) ? "Недвижимость" : "ЗУ"',
            'type' => 'html',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
