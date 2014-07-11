<h1>Добавить информацию</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'action' => 'property/create')); ?>

<!--<div id="upload-wrapper">
    <div align="center">
        <h3>Ajax Image Uploader</h3>
        <form action="<?php //echo Yii::app()->createAbsoluteUrl("site/processimageupload");      ?>" method="post" enctype="multipart/form-data" id="MyUploadForm">
            <input name="ImageFile" id="imageInput" type="file" />
            <input type="submit"  id="submit-btn" value="Upload" />
            <img src="<?php // echo Yii::app()->request->baseUrl;      ?>/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
        </form>
        <div id="output"></div>
    </div>
</div>-->

<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.min.js'></script>

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
                var options = $("#Property_purpose");
                options.empty();
                options.append($("<option />").val('').text(''));
                $.each(data, function(i) {
                    options.append($("<option />").val(data[i]).text(data[i]));
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            target: '#output', // target element(s) to be updated with server response 
            beforeSubmit: beforeSubmit, // pre-submit callback 
            success: afterSuccess, // post-submit callback 
            resetForm: true        // reset the form after successful submit 
        };

        $('#MyUploadForm').submit(function() {
            $(this).ajaxSubmit(options);
            // always return false to prevent standard browser submit and page navigation 
            return false;
        });
    });

    function afterSuccess()
    {
        $('#submit-btn').show(); //hide submit button
        $('#loading-img').hide(); //hide submit button

    }

//function to check file size before uploading.
    function beforeSubmit() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {

            if (!$('#imageInput').val()) //check empty input filed
            {
                $("#output").html("Are you kidding me?");
                return false
            }

            var fsize = $('#imageInput')[0].files[0].size; //get file size
            var ftype = $('#imageInput')[0].files[0].type; // get file type


            //allow only valid image file types 
            switch (ftype)
            {
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                    break;
                default:
                    $("#output").html("<b>" + ftype + "</b> Тип файла не подддерживается!");
                    return false
            }

            //Allowed file size is less than 1 MB (1048576)
            if (fsize > 1048576)
            {
                $("#output").html("<b>" + bytesToSize(fsize) + "</b> Слишком большой размер файла! <br />");
                return false
            }

            $('#submit-btn').hide(); //hide submit button
            $('#loading-img').show(); //hide submit button
            $("#output").html("");
        }
        else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output").html("Пожалуйста, обновите версию Вашего браузера!");
            return false;
        }
    }

//function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0)
            return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

</script>