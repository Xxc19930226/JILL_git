<?
$access_token = "1445696315.c1869c2.8ec2ec96fb7e4738b7e35c605ec8310c";
$user_id = "1445696315";
$obj = json_decode(@file_get_contents("https://api.instagram.com/v1/users/{$user_id}/media/recent?count=1&access_token={$access_token}"));

$instagram_date = date ('Y.m.d', $obj->data[0]->caption->created_time);
$instagram_link = $obj->data[0]->link;
$instagram_comments = $obj->data[0]->comments->count;
$instagram_likes = $obj->data[0]->likes->count;
$instagram_image = $obj->data[0]->images->standard_resolution->url;
?>
