<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>


<?if ( !(isset($_REQUEST["sort"]) && isset($_REQUEST["method"])) && !(isset($_REQUEST["filter"]) && $_REQUEST["filter"] == "Y") ):?>
<div class="container" id="main">
	<div class="row align-items-center" id="filter-wrapper">

		<div class="col-2" id="logo">
			<img src="<?=SITE_TEMPLATE_PATH;?>/assets/images/tickets-logo.svg">
		</div>

		<div class="col-10">
	
			<form id="filter-form" action="" class="">
	
				<select class="filter-form-input city-select" name="station-from" id="station-from">
					<option value="" disabled="" selected="" hidden="">откуда</option>
					<?=$arResult["CITIES_SELECT"];?>
				</select>
	
				<select class="filter-form-input city-select" name="station-to" id="station-to">
					<option value="" disabled="" selected="" hidden="">куда</option>
					<?=$arResult["CITIES_SELECT"];?>
				</select>
	
				<input class="filter-form-input" type="text" name="dep-date" id="datepicker" value="<?=( isset($_REQUEST["dep-date"]) ? $_REQUEST["dep-date"] : "" ); ?>">
				<input class="filter-form-input" type="hidden" name="dep-date-alt" id="dep-date-alt" value="">
	
				<input class="filter-form-input" type="hidden" name="filter" id="filter">
	
				<button class="filter-form-input" id="searchBtn">Найти</button>
	
			</form>
	
		</div>
	</div>
	
	<div class="row align-items-center" id="table-head-wrapper">
		<div class="col-3 sorting-header" id="prop_train_name" data-sort-prop="TRAIN_NAME" data-sort-ord="asc">
			Поезд
		</div>
		<div class="col-1" id="">
			№ пути
		</div>
		<div class="col-2 sorting-header" id="prop_train_dep" data-sort-prop="property_TRAIN_DEP_DATETIME" data-sort-ord="asc">
			Отправление
		</div>
		<div class="col-2 sorting-header" id="prop_train_arr" data-sort-prop="property_TRAIN_ARR_DATETIME" data-sort-ord="asc">
			Прибытие
		</div>
		<div class="col-2" id="">
			Свободные места
		</div>
		<div class="col-2" id="">
			&nbsp;
		</div>
	</div>

	<div class="" id="table-row-wrapper">

<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="row align-items-center train-row" id="" data-train-id="<?=$arItem['ID']?>" data-train-name="<?=$arItem["NAME"]?>_<?=$arItem['ID']?>">

			<div class="col-3" id="">
				<div class="row">
					<div class="col-2" id="">
						<span class="train_number"><?=$arItem["PROPERTIES"]["TRAIN_NUMBER"]["VALUE"]?></span>
					</div>
					<div class="col-10" id="">
						<span class="train_name"><?=$arItem["NAME"]?></span>
						<span class="train_carrier"><?=$arItem["PROPERTIES"]["TRAIN_CARRIER"]["VALUE"]?></span>
					</div>
				</div>
			</div>
	
			<div class="col-1" id="">
				<span class="train_way_num"><?=$arItem["PROPERTIES"]["TRAIN_WAY_NUM"]["VALUE"]?></span>
			</div>
			<div class="col-2" id="">
				<span class="train_dep_date"><?=$arItem["PROPERTIES"]["TRAIN_DEP_DATETIME"]["VALUE"]?></span>
			</div>
			<div class="col-2" id="">
				<span class="train_arr_date"><?=$arItem["PROPERTIES"]["TRAIN_ARR_DATETIME"]["VALUE"]?></span>
			</div>
			<div class="col-2" id="">
				<span class="train_vac_seats"><?=$arItem["PROPERTIES"]["TRAIN_SEATS"]["VACANT_SEATS_NUM"]?></span>
			</div>
			<div class="col-2" id="">
				<button class="btn btn-outline-primary btn-sm" id="">Купить билет</button>
			</div>
			<div class="col-12 d-none- train-order" id="">
				<div class="row">
					<div class="col-6">
						<div class="vagon-wrapper">
							<div class="seats-wrapper">

<?
								for ($x = 1; $x <= 40; $x++) {
?>
									<div class="seat<?=( in_array($x, $arItem["PROPERTIES"]["TRAIN_SEATS"]["VALUE_ENUM_ID"]) ? " occupied" : " vacant" ); ?>" data-train-id="<?=$arItem['ID']?>"><?=$x;?></div>
<?
								}
?>

							</div><!-- seats-wrapper -->
						</div>
					</div>
					<div class="col-6">
						<span>Вы выбрали</span><br/>
						<span class="requested-seats" data-train-id="<?=$arItem['ID']?>">места</span>
					</div>
				</div>

				<div class="row">
					<div class="col-12 form-wrapper" id="form-wrapper-<?=$arItem['ID']?>">
						<!-- AJAX FORM -->
					</div>
				</div>

			</div>
		</div>
<?endforeach;?>

<?if ( !(isset($_REQUEST["sort"]) && isset($_REQUEST["method"])) && !(isset($_REQUEST["filter"]) && $_REQUEST["filter"] == "Y") ):?>
		</div>
	</div>
<?endif;?>