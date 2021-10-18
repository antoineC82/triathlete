$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var val = $(this).attr("value");
            if(val){
                $(".box").not("." + val).hide();
                $("." + val).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
