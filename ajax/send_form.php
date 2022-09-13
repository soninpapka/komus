<?
if ( 1==1 ){
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}else{
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
}
?>

<?
$mail="stanislav.teltevsky@gmail.com";
$subject ="Test" ;

$text= json_encode($_REQUEST);

if( mail($mail, $subject, $text) )
{
echo 'Успешно отправлено!'; }
else{
echo 'Отправка не удалась!';
}
?>