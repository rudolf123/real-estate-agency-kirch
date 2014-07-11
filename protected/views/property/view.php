<h1>Просмотр записи №<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'purpose',
        'address',
        'area',
        'price',
    ),
));
?>
