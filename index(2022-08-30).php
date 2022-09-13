<?
if ( (isset($_REQUEST["sort"]) && isset($_REQUEST["method"])) || (isset($_REQUEST["filter"]) && $_REQUEST["filter"] == "Y") ){
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}else{
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
	$APPLICATION->SetTitle("Главная");
}
?>

<?
//default sorting
$sortField1 = 'NAME';
$sortOrder1 = 'ASC';

$sortField2 = '';
$sortOrder2 = '';

if ( isset($_REQUEST["sort"]) && isset($_REQUEST["method"]) && ( $_REQUEST["sort"] == "property_TRAIN_DEP_DATETIME" || $_REQUEST["sort"] == "property_TRAIN_ARR_DATETIME" || $_REQUEST["sort"] == "TRAIN_NAME" ) ){
	$sortField1 = $_REQUEST["sort"];
	$sortOrder1 = $_REQUEST["method"];

	if( $_REQUEST["sort"] == "TRAIN_NAME" ){

		$sortField1 = "property_TRAIN_FROM_CITY.NAME";
		$sortOrder1 = $_REQUEST["method"];

		$sortField2 = "property_TRAIN_TO_CITY.NAME";
		$sortOrder2 = $_REQUEST["method"];
	}
}

if ( isset($_REQUEST["filter"]) && $_REQUEST["filter"] == "Y" ){
	$GLOBALS['arrFilter'] = array(
		"property_TRAIN_FROM_CITY.NAME"=>( (isset($_REQUEST["station-from"]) && strlen($_REQUEST["station-from"])>0 ) ? $_REQUEST["station-from"] : "" ),
		"property_TRAIN_TO_CITY.NAME"=>( (isset($_REQUEST["station-to"]) && strlen($_REQUEST["station-to"])>0 ) ? $_REQUEST["station-to"] : "" ),
		"%property_TRAIN_DEP_DATETIME"=>( (isset($_REQUEST["dep-date-alt"]) && strlen($_REQUEST["dep-date-alt"])>0 ) ? $_REQUEST["dep-date-alt"] : "" ),
	);
}

?>
	 <?$APPLICATION->IncludeComponent(
	"komus:news.list",
	"tickets_list",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "tickets_list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "trains",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"TRAIN_DEP_DATETIME",1=>"TRAIN_ARR_DATETIME",2=>"TRAIN_SEATS",3=>"TRAIN_NUMBER",4=>"TRAIN_WAY_NUM",5=>"TRAIN_CARRIER",6=>"",),
		"SEARCH_PAGE" => "/search/",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "",
		/*"SORT_BY1" => "ID",*/
		"SORT_BY1" => $sortField1,
		"SORT_BY2" => $sortField2,
		/*"SORT_ORDER1" => "ASC",*/
		"SORT_ORDER1" => $sortOrder1,
		"SORT_ORDER2" => $sortOrder2,
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "red",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
);?>
<?
if ( (isset($_REQUEST["sort"]) && isset($_REQUEST["method"])) || (isset($_REQUEST["filter"]) && $_REQUEST["filter"] == "Y") ){
	/**/
}else{
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
}
?>