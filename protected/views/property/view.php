<h1>Просмотр записи №<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'purpose_id',
            'value' => Purposes::model()->find(
                    'id=:purpose_id', array(
                ':purpose_id' => $model->purpose_id
                    )
            )->name,
        ),
        'address',
        'area',
        'price',
    ),
));
?>
