$('#file_upload1').uploadify({
    'swf': '/extend/upload/uploadify.swf',
    'uploader' : '/extend/upload/uploadify.php',
    'buttonImage':'/static/img/u31.png' ,
    'height':50,
    'width':50,
    'onUploadSuccess' : function(file, data, response) {
        $('#img_yulan1').append("<img src='" + data + "' alt='' height='80' style='margin:30px 5px 5px 5px;'>");
        var url = $('input[name="yy_url"]').val();
        if(typeof(url) == 'undefined'){
            url = data;
            $('#img_yulan1').append("<input name='yy_url' type='text' value="+url+" style='display:none;'>");
        }
        else{
            url = url+'$'+data;
            $('input[name="yy_url"]').val(url);
        }
    }
});
$('#file_upload_thumbnail').uploadify({
    'swf': '/extend/upload/uploadify.swf',
    'uploader' : '/extend/upload/uploadify.php',
    'buttonImage':'/static/img/text.png' ,
    'auto':false,
    'buttonClass':'text',
    'height':32,
    'buttonText':'选择图片',
    'width':190,
    'onUploadSuccess' : function(file, data, response) {
        $('#img_thumbnail').append("<img src='" + data + "' alt='' height='80' style='margin:30px 5px 5px 5px;'>");
        var url = $('input[name="thumbnail"]').val();
        if(typeof(url) == 'undefined'){
            url = data;
            $('#img_thumbnail').append("<input name='thumbnail' type='text' value="+url+" style='display:none;'>");
        }
        else{
            url = url+'$'+data;
            $('input[name="thumbnail"]').val(url);
        }
    }
});
$('#file_upload_slide').uploadify({
    'swf': '/extend/upload/uploadify.swf',
    'uploader' : '/extend/upload/uploadify.php',
    'buttonImage':'/static/img/text.png' ,
    'auto':false,
    'buttonClass':'text',
    'height':32,
    'buttonText':'选择图片',
    'width':190,
    'onUploadSuccess' : function(file, data, response) {
        $('#img_slide').append("<img src='" + data + "' alt='' height='80' style='margin:30px 5px 5px 5px;'>");
        var url = $('input[name="slide"]').val();
        if(typeof(url) == 'undefined'){
            url = data;
            $('#img_slide').append("<input name='slide' type='text' value="+url+" style='display:none;'>");
        }
        else{
            url = url+'$'+data;
            $('input[name="slide"]').val(url);
        }
    }
});