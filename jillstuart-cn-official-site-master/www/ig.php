<?
header('Access-Control-Allow-Origin: *');
$access_token = "1445696315.c1869c2.8ec2ec96fb7e4738b7e35c605ec8310c";
$user_id = "1445696315";
echo file_get_contents("https://api.instagram.com/v1/users/{$user_id}/media/recent?count=1&access_token={$access_token}");
?>
