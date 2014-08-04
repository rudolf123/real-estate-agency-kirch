<h1>Поиск</h1>

<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
            'params' => $params,
    ));
    ?>
</div><!-- search-form -->

<div class="contentborder">
    <?php
    if (!is_null($model))
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $model,
            'itemView' => '_view',
        ));
    ?>
</div>

<script type="text/javascript">

    $('#types_0').click(function() {
        if (this.checked) {
            $('#searchpurposes1').empty();
            $.ajax({
                type: 'post', //тип запроса: get,post либо head
                url: '<?php echo Yii::app()->request->hostInfo . Yii::app()->request->url ?>',
                data: {'ajax_purposes': $(this).val()}, //параметры запроса
                dataType: 'html',
                cache: false,
                success: function(data)
                {
                    $('#searchpurposes1').html(data);
                }
            });

            if (!$('#types_1').checked)
                $('#searcharea').toggle(this.checked);
        }
        $('#areaID1').toggle(this.checked);
        $('#areaID1').val('');
        $('#searchpurposes1').toggle(this.checked);
    });
    $('#types_1').click(function() {
        if (this.checked) {
            $('#searchpurposes2').empty();
            $.ajax({
                type: 'post', //тип запроса: get,post либо head
                url: '<?php echo Yii::app()->request->hostInfo . Yii::app()->request->url ?>',
                data: {'ajax_purposes': $(this).val()}, //параметры запроса
                dataType: 'html',
                cache: false,
                success: function(data)
                {
                    $('#searchpurposes2').html(data);
                }
            });
            if (!$('#types_0').checked)
                $('#searcharea').toggle(this.checked);
        }

        $('#areaID2').toggle(this.checked);
        $('#areaID2').val('');
        $('#searchpurposes2').toggle(this.checked);
    });
</script>
