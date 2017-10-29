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
                            $(".cate-list").trigger('click');
                        }else{
                            $(".has-error").html(operate.errorHtml.replace('%s',responseText.msg));
                        }
                    }
                });
                return false;
            })
        },
        status:function (othis) {
            var status = othis.data('status'),id=othis.data('id');
            layui.use('layer', function() {
                var $ = layui.jquery, layer = layui.layer;
                layer.confirm('确定要执行这个操作吗？', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post('/cate/detail/status',{status:status,id:id},function (data) {
                        layer.close();
                        if(data.code==0){
                            layer.msg('操作成功');
                            window.location.href=location.href;
                        }else{
                            layer.msg('操作失败');
                        }
                    })
                });
            })
        }
    }
    operate.init();

    $(".enable,.delete").on('click',function () {
        operate.status($(this));
    })
})
