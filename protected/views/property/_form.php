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
        'action' => $this->createUrl('property/create'),
        'enableClientValidation' => true,
//        'clientOptions' => array(
//            'validateOnSubmit' => true,
//            'afterValidate' => 'js:function(form,data,hasError)
//                        {
//                            if(!hasError)
//                            {
//                                $("#success").html("Вы подписаны на обновления.");
//                            }
//                        }'
//        ),
        'htmlOptions' => array(
            'accept-charset' => 'UTF-8',
        //'style' => 'width:100%; margin-top:0px; padding-bottom:0px'
        ),
    ));
    ?>
 <div class="errorMessage" id="formResult"></div>

    <p id="success"></p>
    <fieldset>
        <p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

        <table>
            <tr>
                <td><?php echo $form->labelEx($model, 'type'); ?></td>
                <td><?php echo $form->dropDownList($model, 'type', array("Недвижимость", "ЗУ"), array('empty' => '')); ?></td>
            </tr>
            <tr>
                <td> <?php echo $form->labelEx($model, 'purpose_id'); ?></td>
                <td> <?php
                    if (isset($model->type))
                        echo $form->dropDownList($model, 'purpose_id', CHtml::listData(Purposes::model()->findAllByAttributes(
                                                array('type' => $model->type)), 'id', 'name'), array('empty' => ''));
                    else
                        echo $form->dropDownList($model, 'purpose_id', CHtml::listData(Purposes::model()->findAllByAttributes(
                                                array('type' => 0)), 'id', 'name'), array('empty' => ''));
                    ?>
                </td>
                <td><div id="purposeloader"></div></td>
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
        <div class="image-row">
            <input type="file" accept=".gif,.jpg,.jpeg,.png" name="images[]"/>
        </div>
        <!--<div class="file-input-wrapper">
            <img class="example-image" id="img1" style="display: none"/>
            <button class="btn-file-input">+</button>
            <input type="file" name="images[]"/>
        </div>-->
        <?php
//        echo CHtml::submitButton('Сохранить', array('class' => 'my_button_blue'));
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
        echo CHtml::ajaxSubmitButton('Save', CHtml::normalizeUrl(array('property/create', 'render' => true)), array(
            'dataType' => 'json',
            'type' => 'post',
            'success' => 'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         $("#msform")[0].reset();
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#msform #"+key+"_em_").text(val);                                                    
                        $("#msform #"+key+"_em_").show();
                        });
                        }       
                    }',
            'beforeSend' => 'function(){                        
                           $("#AjaxLoader").show();
                      }'
                ), array('id' => 'mybtn', 'class' => 'class1 class2'));
        ?>

    </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img1input").change(function() {
        readURL(this);
    });

    $('#msform').delegate('input[type=file]', 'change', function() {
        var fileName = $(this).val();
        var files = [".gif", ".jpg", ".jpeg", ".png"];
        var checkExt = files.indexOf(fileName.substring(fileName.lastIndexOf("."), fileName.length));
        if (checkExt !== -1)
            addField();
        else
            alert("Файл изображения должен иметь расширение .gif,.jpg,.jpeg,.png");
    });

    function addField() {
        var filename = $('#msform input:file').last().val();
        if (filename.length !== 0)
            $('#msform input:file').last().after($('<input type="file" accept=".gif,.jpg,.jpeg,.png" name="images[]"/>'));
    }
</script>