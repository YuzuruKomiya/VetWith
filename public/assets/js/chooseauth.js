/**
 * トップナビゲーションのログインセレクタ。「学生」「病院」でログイン先を分ける。
 * 
 */
$(function ()
{
    var action   = $('#loginform');
    var username = $('#loginusername');
    var password = $('#loginpassword');
    var selector = $('[name=account]');
    
    var script   = $('#script');
    var s_uri    = JSON.parse(script.attr('data-studenturi'));
    var c_uri    = JSON.parse(script.attr('data-clinicuri'));
    
    $(selector).change(function()
    {
        var val = $(selector).val();
       if (val == 'student')
       {
           $(action).attr('action', s_uri);
           $(username).attr('name', 's_username');
           $(password).attr('name', 's_password');
       }
       else if (val == 'clinic')
       {
           $(action).attr('action', c_uri);
           $(username).attr('name', 'c_username');
           $(password).attr('name', 'c_password');
       }
    });
});
