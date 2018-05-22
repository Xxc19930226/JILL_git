<?
$id = '170410599746788';
$appId = '1520884004811958';
$secret = '3183ddb4ab7d7fc1eb2945db7cfeac61';
$access_token = '1520884004811958|Ci_bbgWWdeRmRjJFysQJP2D1T1k';
$user_token = 'CAAVnPGbZA9LYBAAya3l7pr1f7yPGRvcfIHXgPVQRpLZCIFHwg1XMPjJ1hoqTASltvlcSPENof8JoSpdHAQnYkeBlt13IyVA6CsdDkdsuNSaE3CMZArdrXiZA4MtsWlbKZBrv4AZBp5D2nTZApEhHdrJqWbd2FSJKvrIzZA7Ga6KuaHp064yM44ZAFvSZAlxQR59FWjOwMGyfiGavzdgG8CfWZCF';
$url = 'https://graph.facebook.com/' . $id . '/feed?limit=1&access_token=' . $access_token;
$obj = json_decode(file_get_contents($url));
//var_dump($obj);
$page_id = $obj->data[0]->id;
$date = date_create($obj->data[0]->created_time);
$facebook_date = date_format($date, 'Y.m.d');
$facebook_link = $obj->data[0]->link;
//$facebook_comments = $obj->data[0]->comments->count;
$facebook_likes = count($obj->data[0]->likes->data);
$facebook_image = $obj->data[0]->picture;
$facebook_title = mb_substr($obj->data[0]->message, 0, 100) . " ...";

/*$url2 = 'https://graph.facebook.com/' . $id . '/photos/uploaded?limit=1&picture=' . $facebook_image . '&access_token=' . $access_token;
$obj = json_decode(file_get_contents($url2));
$facebook_image = $obj->data[0]->images[0]->source;*/
?>
