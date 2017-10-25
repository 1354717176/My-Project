/**
 * Created by Administrator on 2017/10/22.
 */
$(function () {
    var operate = {
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
                    title: {
                        validators: {
                            notEmpty: {
                                message: '文章标题不能为空'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '密码不能为空'
                            }
                        }
                    }
                }
            });
        }
    }

    //初始化表单验证
    operate.check();

    $('#articleForm').on("submit",function() {
        $(this).ajaxSubmit({target: '#output'});
        return false;
    });

    //表单提交时验证
    $(".submit").on('click', function () {

        //获得表单验证对象
        var formValidate = $("#articleForm").data('formValidation');

        //表单开始验证
        formValidate.validate();

        //表单验证状态
        var status = formValidate.isValid();

        //表单验证是否通过
        if (status != false) {
            $('#articleForm').submit();
        } else {
            return false;
        }
    })

})
