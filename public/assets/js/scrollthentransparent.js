$(function()
{
$(window).scroll(function()
{
    var scrollTop = $(window).scrollTop();
    if(scrollTop != 0)
        $('#header').stop().animate({'opacity':'0.8'},400);
    else
        $('#header').stop().animate({'opacity':'1'},400);
});
 
$('#header').hover(
    function ()
   {
       var scrollTop = $(window).scrollTop();
       if(scrollTop != 0)
       {
           $('#header').stop().animate({'opacity':'1'},400);
       }
    },
    function ()
    {
       var scrollTop = $(window).scrollTop();
       if(scrollTop != 0)
       {
           $('#header').stop().animate({'opacity':'0.8'},400);
       }
   });
});