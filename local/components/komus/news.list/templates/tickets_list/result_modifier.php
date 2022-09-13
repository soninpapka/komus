<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

function seats_rus($number, $arCases) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number.' '.$arCases[ ($number%100>4 && $number%100<20) ? 2 : $cases[min($number%10, 5)] ];
}


/* CITIES */
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($arr = $res->GetNext(false,false)){
	$arResult["CITIES"][$arr["ID"]] = $arr["NAME"];
	$options .= "<option value='" . $arr["NAME"] . "'>". $arr['NAME'] ."</option>";
}
$arResult["CITIES_SELECT"] = $options;
foreach($arResult["ITEMS"] as $key=>$arItem):
	$trainFromCityName = $arResult["CITIES"][ $arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_FROM_CITY"]["VALUE"] ];
	$trainToCityName = $arResult["CITIES"][ $arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_TO_CITY"]["VALUE"] ];
	$arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_FROM_CITY"]["CITY_NAME"] = $trainFromCityName;
	$arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_TO_CITY"]["CITY_NAME"] = $trainToCityName;

	$vacantSeats = 40 - count($arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_SEATS"]["VALUE_ENUM"]);
	$arResult["ITEMS"][$key]["PROPERTIES"]["TRAIN_SEATS"]["VACANT_SEATS_NUM"] = seats_rus($vacantSeats, ['место', 'места', 'мест']);

	$arResult["ITEMS"][$key]["NAME"] = $trainFromCityName . "&nbsp;&mdash;&nbsp;" . $trainToCityName;



endforeach;
?>