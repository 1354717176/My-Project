$(function () {
    var operate = {
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
                            threshold: 5,
                            remote: {
                                url: $(".submit").data('captcha-url'),
                                message: '验证码错误',
                                delay: 500,
                                type: 'POST',
                                data: function (validator) {
                                    return {
                                        id: $(".captcha").data('id'),
                                    };
                                }
                            },
                        }
                    }
                }
            });
        }
    }

    //验证码刷新
    $(".captcha").on('click', function () {
        operate.captcha(this, $(this).data('id'), $(this).data('url'))
    })

    //表单提交时验证
    $(".submit").on('click', function () {

        //初始化表单验证
        operate.check();

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
    })

})