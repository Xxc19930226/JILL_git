<?
header('Access-Control-Allow-Origin: *');
$id = '170410599746788';
$appId = '1520884004811958';
$secret = '3183ddb4ab7d7fc1eb2945db7cfeac61';
$access_token = '1520884004811958|Ci_bbgWWdeRmRjJFysQJP2D1T1k';
$user_token = 'CAAVnPGbZA9LYBAAya3l7pr1f7yPGRvcfIHXgPVQRpLZCIFHwg1XMPjJ1hoqTASltvlcSPENof8JoSpdHAQnYkeBlt13IyVA6CsdDkdsuNSaE3CMZArdrXiZA4MtsWlbKZBrv4AZBp5D2nTZApEhHdrJqWbd2FSJKvrIzZA7Ga6KuaHp064yM44ZAFvSZAlxQR59FWjOwMGyfiGavzdgG8CfWZCF';
$url = 'https://graph.facebook.com/' . $id . '/feed?limit=1&access_token=' . $access_token;
echo file_get_contents($url);
?>
