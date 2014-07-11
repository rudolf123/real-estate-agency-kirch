<h1>Поиск</h1>

<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<script type="text/javascript">

    $('#types_0').click(function() {
        if (this.checked) {
            $('#searchpurposes').empty();
            $.ajax({
                type: 'post', //тип запроса: get,post либо head
                url: '<?php echo Yii::app()->request->hostInfo . Yii::app()->request->url ?>',
                data: {'ajax_purposes': $(this).val()}, //параметры запроса
                dataType: 'html',
                cache: false,
                success: function(data)
                {
                    $('#searchpurposes').html(data);
                }
            });
        }
        $('#searchpurposes').toggle(this.checked);
    });
    $('#types_1').click(function() {
        if (this.checked) {

            $.ajax({
                type: 'post', //тип запроса: get,post либо head
                url: '<?php echo Yii::app()->request->hostInfo . Yii::app()->request->url ?>',
                data: {'ajax_purposes': $(this).val()}, //параметры запроса
                dataType: 'html',
                cache: false,
                success: function(data)
                {
                    $('#searchpurposes').empty();
                    $('#searchpurposes').html(data);
                }
            });
        }
    });
</script>
