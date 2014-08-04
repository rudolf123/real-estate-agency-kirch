<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/960.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" media="screen, projection"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lightbox.css" media="screen, projection" />
        <script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.0.min.js'></script>
        <script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox.min.js'></script>
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="page">
            <div id="header">
                <header>
                    <div id="logo">
                        <h1>АН "Кирш"</h1>
                    </div>
                </header>
            </div>
            <div id="mainmenu" class="menu">
                <nav id="nav">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Главная', 'url' => array('/site/index')),
                            array('label' => 'Недвижимость и ЗУ', 'url' => array('/property/index')),
                            array('label' => 'Поиск', 'url' => array('/property/search')),
                            array('label' => 'Личный кабинет', 'url' => array('user/profile'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Вход', 'url' => array('user/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Выйти (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </nav>
            </div>
        </div>
        <!-- Main -->

        <div class="page">
            <div id="content">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="page">
            <div id="footer">
                <footer>
                    Разработчик: Юранов Владимир (rudolf123@narod.ru).<br/>
                    <?php echo Yii::powered(); ?>
                </footer>
            </div><!-- footer -->
        </div>
    </body>
    
</html>
