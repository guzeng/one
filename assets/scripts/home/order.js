$(document).ready(function(){
    $("#create_time").change(function(){
        var create_time = $("#create_time").val();
        var base_url = $("#orderTab li").filter(".active").find("a").attr('href');
        if(create_time.length>0)
          location.href = base_url+"/create_time/"+create_time;
    });
    $("#search_btn").click(function(){
        var keyword = $("#keyword").val();
        var base_url = $("#orderTab li").filter(".active").find("a").attr('href');
        if(keyword.length>0)
          location.href = base_url+"/keyword/"+keyword;
    });
});

