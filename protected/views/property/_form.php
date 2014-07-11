<?php
/* @var $this PropertyController */
/* @var $model Property */
/* @var $form CActiveForm */
?>

<div class="row" align="center">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'msform',
        'enableAjaxValidation' => true,
        //'enableClientValidation' => true,
        'htmlOptions' => array(
            'accept-charset' => 'UTF-8',
        //'style' => 'width:100%; margin-top:0px; padding-bottom:0px'
        ),
    ));
    ?>
    <div id="success"></div>


    <fieldset>
        <p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

        <table>
            <tr>
                <td><?php echo $form->labelEx($model, 'type'); ?></td>
                <td><?php echo $form->dropDownList($model, 'type', array("Недвижимость", "ЗУ"), array('empty' => '')); ?></td>
            </tr>
            <tr>
                <td> <?php echo $form->labelEx($model, 'purpose'); ?></td>
                <td> <?php
                    echo $form->dropDownList($model, 'purpose', CHtml::listData(Purposes::model()->findAllByAttributes(
                                            array('type' => 0)), 'name', 'name'), array('empty' => ''));
                    ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model, 'address'); ?></td>
                <td><?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 200)); ?></td>

            </tr>
            <tr>
                <td> <?php echo $form->labelEx($model, 'area'); ?></td>
                <td> <?php echo $form->textField($model, 'area'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $form->labelEx($model, 'price'); ?></td>
                <td> <?php echo $form->textField($model, 'price'); ?></td>
            </tr>
        </table>


        <?php
        echo CHtml::submitButton('Сохранить', array('class' => 'my_button_blue'));
//        echo CHtml::ajaxSubmitButton('Save', CHtml::normalizeUrl(array($action)), array(
//            'dataType' => 'json',
//            'type' => 'post',
//            'success' => 'function(data) 
//                    {
//                      if(data.status=="success")
//                      {
//                        $("#success").html("Вы подписаны на обновления.");
//                        $("#msform")[0].reset();
//                      }
//                      else
//                      {
//                        $.each(data, function(key, val) 
//                        {
//                          $("#msform #"+key+"_em_").text(val);
//                          $("#msform #"+key+"_em_").show();
//                        });
//                      }
//                    }'
//        ));
        ?>

    </fieldset>

    <?php $this->endWidget(); ?>

</div><!-- form -->