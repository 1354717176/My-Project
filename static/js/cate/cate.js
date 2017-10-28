/**
 * Created by Administrator on 2017/10/22.
 */
$(function () {
    var operate = {
        errorHtml:'<label class="col-sm-3 col-md-2 control-label"></label><p class="col-sm-9 col-md-6 help-block"><i class="icon wb-close" aria-hidden="true" style="font-size:12px"></i>%s</p>',
        check: function () {
            //表单验证
            $('#articleForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'icon wb-check',
                    invalid: 'icon wb-close',
                    validating: 'icon wb-refresh'
                },

                // List of fields and their validation rules
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: '分类名称不能为空'
                            }
                        }
                    }
                }
            })
            .on('success.form.fv', function(e) {
                var $form = $(e.target);
                $form.ajaxSubmit({
                    url: $form.attr('action'),
                    type:'post',
                    dataType: 'json',
                    success: function(responseText, statusText, xhr, $form) {
                        if(responseText.code == 0){
                            $(".article-list").trigger('click');
                        }else{
                            $(".has-error").html(operate.errorHtml.replace('%s',responseText.msg));
                        }
                    }
                });
                return false;
            })
        }
    }

    //初始化表单验证
    operate.check();

})
