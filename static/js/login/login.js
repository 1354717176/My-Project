$(function () {
    var operate = {
        errorHtml:'<p class="col-sm-9 col-md-6 help-block" style="padding:0"><i class="icon wb-close" aria-hidden="true" style="font-size:12px"></i>%s</p>',
        captcha: function (obj, id, url) {
            //刷新验证码
            $.ajax({
                type: 'post',
                url: url,
                data: {id: id},
                success: function (data) {
                    if (data.code == 0) {
                        $(obj).attr('src', data.data.url).data('id', data.data.id);
                    } else {

                    }
                }
            })
        },
        check: function () {
            //表单验证
            $('#loginForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'icon wb-check',
                    invalid: 'icon wb-close',
                    validating: 'icon wb-refresh'
                },

                // List of fields and their validation rules
                fields: {
                    loginName: {
                        validators: {
                            notEmpty: {
                                message: '用户名不能为空'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '密码不能为空'
                            }
                        }
                    },
                    validCode: {
                        validators: {
                            notEmpty: {
                                message: '验证码不能为空'
                            },
                        }
                    }
                }
            }).on('success.form.fv', function(e) {
                var $form = $(e.target);
                $form.ajaxSubmit({
                    url: $form.attr('action'),
                    type:'post',
                    data: {
                        'id': $form.find('.captcha').data('id'),
                    },
                    dataType: 'json',
                    success: function(responseText, statusText, xhr, $form) {
                        if(responseText.code == 0){
                            window.location.href='/';
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

    //验证码刷新
    $(".captcha").on('click', function () {
        operate.captcha(this, $(this).data('id'), $(this).data('url'))
    })

    /*//表单提交时验证
    $(".submit").on('click', function () {

        //获得表单验证对象
        var formValidate = $("#loginForm").data('formValidation');

        //表单开始验证
        formValidate.validate();

        //表单验证状态
        var status = formValidate.isValid();

        //表单验证是否通过
        if (status != false) {
            window.location.href='/';
        } else {
            return false;
        }
    })*/

})