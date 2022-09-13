<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(isset($_REQUEST["trainName"])){
	$arResult["QUESTIONS"]["TRAIN_ID"]["VALUE"] = $_REQUEST["trainName"];
}
?>