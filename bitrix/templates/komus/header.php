<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<?
use Bitrix\Main\Page\Asset;
//jquery CDN
//Asset::getInstance()->addJs("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
//jquery server
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery-3.6.0.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.tablesorter.min.js", true);

Asset::getInstance()->addJs("https://code.jquery.com/ui/1.13.2/jquery-ui.js", true);
Asset::getInstance()->addCss("https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css");

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.mask.min.js", true);
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.validate.min.js", true);


Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/script.js", true);

Asset::getInstance()->addJs("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js");
Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/style_kom.css");

?>
<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2" /> 	
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>