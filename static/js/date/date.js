/**
 * Created by Administrator on 2017/10/22.
 */
$(function () {
    layui.use('laydate', function() {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#test5'
            , type: 'datetime'
        });
    })
})
