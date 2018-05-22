<?
$_lang = '/';
$_uris = explode('/', $_SERVER["REQUEST_URI"]);
if(count($_uris) > 0) $_lang .= $_uris[1];
?>

