<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<!-- request_form_template_php -->

<? if ($arResult["isFormNote"] === "Y"): ?>
    Спасибо, ваша заявка принята!
<? else: ?>

<?//=$arResult["FORM_HEADER"]?>

<input type="hidden" name="web_form_submit" value="Y">

    <? if ($arResult["isFormErrors"] === "Y"): ?>
        <div class="errors">
            <?=$arResult["FORM_ERRORS_TEXT"]?>
        </div>
    <? endif; ?>

<form id="ticketsRequest">
<div class="row my-3">
	<div class="col">
		<?=$arResult["QUESTIONS"]['PHONE']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['EMAIL']['HTML_CODE']?>
	</div>
</div>
<div class="row my-3">
	<div class="col-8">
		<?=$arResult["QUESTIONS"]['F_NAME']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['NAME']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['O_NAME']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['B_DATE']['HTML_CODE']?>
	</div>
	<div class="col-4">
		<div class="sex_wrapper">
			<?=$arResult["QUESTIONS"]['SEX']['HTML_CODE']?>
		</div>
		<div class="row sex_labels_wrapper">
			<label for="male_<?=$_REQUEST["trainId"]?>" class="col-1 sex_labels male_label checked">
				М
			</label>
			<label for="female_<?=$_REQUEST["trainId"]?>" class="col-1 sex_labels female_label">
				Ж
			</label>
		</div>
	</div>
</div>
<div class="row my-3">
	<div class="col">
		<?=$arResult["QUESTIONS"]['CITIZEN']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['DOC_NUM']['HTML_CODE']?>
		<?=$arResult["QUESTIONS"]['DOC_VALID']['HTML_CODE']?>
	</div>
</div>


<?=$arResult["QUESTIONS"]['TRAIN_ID']['HTML_CODE']?>
<?=$arResult["QUESTIONS"]['TRAIN_SEATS']['HTML_CODE']?>

		<button class="request-form-input" id="request-form-submit" value="<?=$arResult["arForm"]["BUTTON"]?>">Забронировать</button>
		<?//=$arResult["FORM_FOOTER"]?>
</form>
<? endif; ?>

<?
/*echo "<pre>_REQUEST: <br>";
print_r($_REQUEST);
echo "</pre>";
?>

<?
echo "<pre>arResult: <br>";
print_r($arResult["QUESTIONS"]);
echo "</pre>";*/
?>


