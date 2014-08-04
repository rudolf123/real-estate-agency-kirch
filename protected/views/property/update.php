<h1>Изменение записи №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<script type="text/javascript">

    $('#Property_type').change(function() {

        $.ajax({
            type: 'post', //тип запроса: get,post либо head
            url: '<?php echo Yii::app()->request->hostInfo . Yii::app()->request->url ?>',
            data: {'ajax_purposes': $(this).val()}, //параметры запроса
            dataType: 'json',
            cache: false,
            success: function(data)
            {
                var options = $("#Property_purpose_id");
                options.empty();
                options.append($("<option />").val('').text(''));
                $.each(data, function(i, elem) {
                    options.append($("<option />").val(i).text(elem));
                });
            }
        });
    });
</script>