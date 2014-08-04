<h1>Недвижимость и ЗУ</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'property-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'purpose_id',
            'value' => 'Purposes::model()->find(
                    "id=:purpose_id", array(
                ":purpose_id" => $data->purpose_id))->name',
        ),
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
