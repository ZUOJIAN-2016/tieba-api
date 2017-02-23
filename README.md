### register  
URL:http://zuojian100steps.duapp.com/Router.php/user/[POST参数]  
method:POST  
parameters:'user_name''user_password''user_avatar'
### login
URL：http://zuojian100steps.duapp.com/Router.php/user/[GET参数]  
method:GET  
parameters:'user_name''user_password'
### user_to_theme_post
URL:http://zuojian100steps.duapp.com/Router.php/user/theme_post/[GET参数]  
method:GET
parameters:'user_name'
### user_to_reply_post
URL:http://zuojian100steps.duapp.com/Router.php/user/reply_post/[GET参数]  
method:GET
parameters:'user_name'
### bulid_bar
URL:http://zuojian100steps.duapp.com/Router.php/bar/[POST参数]  
method:POST  
parameters:'bar_name''bar_avatar'  
### bar_info
URL:http://zuojian100steps.duapp.com/Router.php/bar/bar_info  
RETURN:ALL BARS_INFO(JSON)  
### bar_theme_post
URL:http://zuojian100steps.duapp.com/Router.php/bar/theme_post/[GET参数]
method:GET
parameters:'bar_name'  
### follow_bar
URL:http://zuojian100steps.duapp.com/Router.php/bar/follower/[GET参数]  
method:GET  
parameters:'bar_name','user_name'
### new_theme_post
URL:http://zuojian100steps.duapp.com/Router.php/post/theme_post/[POST参数]  
method:POST  
parameters:'title''content'post_number''pictures''user_name''bar_name''post_time'
### user_view_theme_post
URL:http://zuojian100steps.duapp.com/post/theme_post/[GET参数]  
method:GET  
parameters:'user_name'
### new_reply_post
URL:http://zuojian100steps.duapp.com/Router.php/post/reply_post/[POST参数]  
method:POST  
parameters:'theme_title''content'post_number''pictures''user_name''bar_name''post_time' 
### user_view_theme_post
URL:http://zuojian100steps.duapp.com/post/theme_post/[GET参数]  
method:GET  
parameters:'user_name'