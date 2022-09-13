<?
if ( 1==1 ){
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}else{
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
}
?>


<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"request_form", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "1",
		"COMPONENT_TEMPLATE" => "request_form",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		),
"AJAX_MODE" => "Y",
"AJAX_OPTION_SHADOW" => "N",
"AJAX_OPTION_JUMP" => "N",
"AJAX_OPTION_STYLE" => "Y",
"AJAX_OPTION_HISTORY" => "N",
	),
	false
);?>