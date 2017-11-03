/**
 * Created by Administrator on 2017/10/22.
 */
$(function () {
    var operate = {
        errorHtml:'<label class="col-sm-3 col-md-2 control-label"></label><p class="col-sm-9 col-md-6 help-block"><i class="icon wb-close" aria-hidden="true" style="font-size:12px"></i>%s</p>',
        init:function () {
            operate.check();
        },
        check: function () {
            //表单验证
            $('#memberForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'icon wb-check',
                    invalid: 'icon wb-close',
                    validating: 'icon wb-refresh'
                },

                // List of fields and their validation rules
                fields: {
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: '用户名不能为空'
                            },
                            stringLength: {
                                min: 1,
                                max: 30,
                                message: '长度应在1-30位之间'
                            },
                        }
                    },
                    pass_word:{
                        validators:{
                            identical: {
                                field: 'confrim_pass_word',
                                message: '两次密码输入不一样'
                            }
                        }
                    },
                    confrim_pass_word:{
                        validators:{
                            identical: {
                                field: 'pass_word',
                                message: '两次密码输入不一样'
                            }
                        }
                    },
                    number:{
                        validators:{
                            notEmpty:{
                                message:'名额不能为空'
                            },
                            between: {
                                min: 0,
                                max: 100000,
                                inclusive:true,
                                message: '名额在0-100000之间'
                            },
                            integer:{
                                message:'名额为整数'
                            }
                        }
                    }
                }
            }).on('success.form.fv', function(e) {
                    var $form = $(e.target);
                    $form.ajaxSubmit({
                        url: $form.attr('action'),
                        type:'post',
                        dataType: 'json',
                        success: function(responseText, statusText, xhr, $form) {
                            if(responseText.code == 0){
                                $(".member1-list").trigger('click');
                            }else{
                                $(".has-error").html(operate.errorHtml.replace('%s',responseText.msg));
                            }
                        }
                    });
                    return false;
                })
        }
    }
    operate.init();
})
