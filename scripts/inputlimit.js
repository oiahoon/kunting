/**
 * 微博计数输入框插件
 * 属性说明：
 * counter 计数区的容器id
 * max 最大字符数，默认值为150
 * textClass 指定文字的样式
 * normalClass 指定未超过最大字数时数字样式
 * errorClass 指定已超过最大字数时数字样式
 */
(function($){
    $.fn.extend({
        weiboInputBox: function(options) {    //插件名字
            var defaults={
                counter:"msg",    //计数容器id
                max:150,
                textClass:"textClass",
                normalClass:"normalClass",
                errorClass:"errorClass"
            };
            var options=$.extend(defaults,options);
            return this.each(function() {
                var o=options;    //得到配置参数
                var obj=$(this);    //得到当前对象
                $("#"+o.counter).addClass(o.textClass)
                    .html("您还可以输入<span class='"+o.normalClass+"'>"+o.max+"</span>字");
                // 以下为超过字数时候强制吧key值置为0 ，不需要，只需要给出提示
                // obj.bind("keypress",function(event){
                //     var l=obj.val().length+1;
                //     var maxlength=obj.attr("maxlength");
                //     if(l>maxlength){
                //         window.event.keyCode=0;
                //     }
                // });
                obj.bind("keyup change",function(event){
                    var val=obj.val();
                    var vLength=val.length;
                    //var addLen=(val.match(/[^\x00-\xff]|[\u4E00-\u9FA5]/g)||'').length;    //2个英文字符计为1个
                    var addLen=val.length;    //1个英文字符计为1个
                    var num=o.max-Math.ceil((vLength+addLen)/2);
                    
                    if(num>=0){
                        $("#"+o.counter).addClass(o.textClass)
                            .html("您还可以输入<span class='"+o.normalClass+"'>"+num+"</span>字");
                    }else{
                        $("#"+o.counter).addClass(o.textClass)
                            .html("已超过<span class='"+o.errorClass+"'>"+Math.abs(num)+"</span>字,会被自动截断，并且可能会推送失败。");
                    }
                });
            });
        }
    });
})(jQuery);