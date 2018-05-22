<?
$_lang = '/';
$_uris = split('/', $_SERVER["REQUEST_URI"]);
if(count($_uris) > 0) $_lang .= $_uris[1];
header('Location:' . $_lang, true, 301);
exit();
?>
