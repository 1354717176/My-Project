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
                    tel: {
                        validators: {
                            notEmpty: {
                                message: '电话不能为空'
                            },
                            regexp:{
                                regexp:/1[3|4|7|5|8]\d{9}$|400[0-9]{7}$|0[0-9]{2,3}-[0-9]{7,8}$/,
                                message:'电话不正确',
                            }
                        }
                    },
                    detail: {
                        validators: {
                            notEmpty: {
                                message: '电话不能为空'
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
                            layui.use('layer', function() {
                                layer.msg('操作成功');
                            })
                        }else{
                            $(".has-error").html(operate.errorHtml.replace('%s',responseText.msg));
                        }
                        $('button[type="submit"]').removeClass('disabled').removeAttr('disabled');
                    }
                });
                return false;
            })
        },
        ueditor:function () {
            var ue = UE.getEditor('detail',{
                toolbars: [
                    ['fullscreen', 'source', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc','fontfamily','fontsize']
                ]
            });
        }
    }
    operate.init();
    operate.ueditor();
})
