<div class="row">
    <h1>Авторизация</h1>

    <?php
    $forms = $this->beginWidget('CActiveForm', array(
        'id' => 'msform',
        'enableClientValidation' => true,
        //'enableAjaxValidation'=>true, // <<<<------ валидация по AJAX
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
        ),
        'htmlOptions' => array(
            'accept-charset' => 'UTF-8',
        ),
        'action' => array('user/login'),
    ));
    ?>

    <?php echo $forms->errorSummary($form); ?><br />
    <fieldset>
        <table align="center">
            <td>
                <?php echo $forms->textField($form, 'login', array('placeholder' => 'Имя пользователя')) ?>
            </td>
            <tr>
                <td>
                    <?php echo $forms->passwordField($form, 'passwd', array('placeholder' => 'Пароль')) ?>
                </td>
            </tr>
        </table>
        <div align="center">
                <?php echo CHtml::submitButton('Войти', array('class' => 'my_button_blue')); ?>
            <div style="margin-top: 10px">

                <?php echo CHtml::link('Регистрация нового пользователя', array('user/registration')); ?>
            </div>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>
</div>