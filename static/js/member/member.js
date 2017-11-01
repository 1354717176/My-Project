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
                            regexp: {
                                regexp: /^[a-zA-Z0-9_]+$/,
                                message: '请输入字母数字和下划线'
                            },
                            stringLength: {
                                min: 5,
                                max: 30,
                                message: '长度应在5-30位之间'
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
                    }
                    /*pass_word:{
                        validators:{
                            callback:{
                                message:'两次密码输入不一样',
                                callback: function(value, validator, $field) {
                                    if(value != validator.getFieldElements("confrim_pass_word").val()){
                                        return false;
                                    }
                                    var confrimPassWord = $('input[name="confrim_pass_word"]');
                                    confrimPassWord.parents('.form-group').removeClass('has-error').addClass('has-success');
                                    confrimPassWord.parents('.form-group').find('i').removeClass('wb-close').addClass('wb-check');
                                    confrimPassWord.parents('.form-group').find('small').hide().attr('fv-result','VALID');
                                    return true;
                                },
                            }
                        }
                    },
                    confrim_pass_word:{
                        validators:{
                            callback:{
                                message:'两次密码输入不一样',
                                callback: function(value, validator, $field) {
                                    if(value != validator.getFieldElements("pass_word").val()){
                                        return false;
                                    }
                                    var passWord = $('input[name="pass_word"]');
                                    passWord.parents('.form-group').removeClass('has-error').addClass('has-success');
                                    passWord.parents('.form-group').find('i').removeClass('wb-close').addClass('wb-check');
                                    passWord.parents('.form-group').find('small').hide().attr('fv-result','VALID');
                                    return true;
                                },
                            }
                        }
                    }*/
                }
            }).on('success.form.fv', function(e) {
                    var $form = $(e.target);
                    $form.ajaxSubmit({
                        url: $form.attr('action'),
                        type:'post',
                        dataType: 'json',
                        success: function(responseText, statusText, xhr, $form) {
                            if(responseText.code == 0){
                                window.location.href='/login/index/out';
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
