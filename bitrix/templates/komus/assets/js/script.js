function testFillForm(){
	$("#ticketsRequest").find("input[name='form_text_1']").val("79995612389");
}

function validateField( el ) {
	var retVar = false;
	if( el.val().length < 1 ){
		retVar = false;

		alert( ( el.attr('name') == 'form_hidden_23' ? 'Выберите ' + el.attr("placeholder") : 'Заполните "' + el.attr("placeholder") + '"') );

	} else {
		if( el.hasClass('email') ){
			if( !validEmail( el.val() ) ){
				retVar = false;
				alert('Неверный ' + el.attr("placeholder") );
			}else{
				retVar = true;
			};
		}else{
			retVar = true;
		}
	}
	( retVar ? el.removeClass('empty') : el.addClass('empty') );
	return retVar;
}

function validateForm( formEl ) {
	var formValid = true;
	formEl.find(".request-form-input").each( function (index, element){
		var fieldValid = validateField( $(this) );
		formValid = formValid && fieldValid;
	});
	return formValid;
}


function validEmail(email) {
  var regexpr = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
  return regexpr.test(email);
}

function trainRowInit() {

	$(".form-wrapper").click(function(){
		event.stopPropagation();
	});

	$(".train-row").click(function(){
		$(this).siblings().children(".train-order").hide(500);
		$(this).children(".train-order").show(500);
		$(".train-row").removeClass("opened");
		$(this).addClass("opened");

		var trainId = $(this).data("train-id");
		var trainName = $(this).data("train-name");
		reqFormInit( trainId, trainName );

	});

	$(".vacant").on({
		"click": function() {
			event.stopPropagation();
			$(this).toggleClass("requested");

			var trainId = $(this).data("train-id");
			var trainName = $(".train-row[data-train-id=" + trainId + "]").data("train-name");
			var reqSeatsTarget = $(".requested-seats[data-train-id=" + trainId + "]");
			var reqFormTarget = $("#form-wrapper-" + trainId + "");

			var reqSeatsText = "";
			$(this).parent().children(".requested").each( function (index, element){
				reqSeatsText += (index==0) ? '' : ', ';
				reqSeatsText += $(this).html();
			});
			if( reqSeatsText == "" ){
				reqSeatsTarget.hide();
			}else{
				reqSeatsTarget.show();
				var placesLabel = (reqSeatsText.length > 2) ? ' места' : ' место';
				reqSeatsTarget.html("" + reqSeatsText + "" + placesLabel);
				//fill request form input
				reqFormTarget.find("input[name='form_hidden_22']").val(trainName);
				reqFormTarget.find("input[name='form_text_22']").val(trainName);
				//reqFormTarget.find("input[name='form_hidden_22']").attr("value", trainName);

				reqFormTarget.find("input[name='form_hidden_23']").val(reqSeatsText);
				reqFormTarget.find("input[name='form_text_23']").val(reqSeatsText);
				//reqFormTarget.find("input[name='form_text_23']").attr("value", reqSeatsText);
			}
		}
	});

}





function reqFormInit( trainId, trainName ) {

	var hasForm = $(".train-row[data-train-id=" + trainId + "]").data("has-form");
	if ( !hasForm || hasForm != "y"){
		var data = "trainId=" + trainId + "&trainName=" + trainName;
		var reqFormTarget = $("#form-wrapper-" + trainId + "");

		/* KILL ALL FORMS */
		/* FED UP WITH IDs REPEATS */
		$(".form-wrapper").not(reqFormTarget).html("");
		$(".train-row").data("has-form", "n").attr("data-has-form","n");

		$.post({
			url: '/ajax/form.php',
			data: data,
		})
		.done(function (data) {
			if (data) {
				reqFormTarget.html("" + data + "");

				testFillForm();

				$(".train-row[data-train-id=" + trainId + "]").data("has-form", "y").attr("data-has-form","y");
				reqFormTarget.find("input[name='form_text_22']").val(trainName);

				$('.phone').mask('+7 (000) 000-00-00',/*{placeholder: "Телефон: +7 (XXX) XXX-XX-XX"}*/);

				reqFormTarget.find("input[id='male']").attr("id", "male_" + trainId);
				reqFormTarget.find("input[id='female']").attr("id", "female_" + trainId);

				$(".sex_labels").click(function(){
					if( !$(this).hasClass("checked") ){
						reqFormTarget.find(".sex_labels").toggleClass("checked");
					}
				});

				$(".request-form-input").on('change', function(e) {
					validateField( $(this) );
				});

				$("#request-form-submit").on('click', function(e) {
					e.preventDefault();

					/* VALIDATE FORM  */
					if ( validateForm( $("#ticketsRequest") ) ) {

						var formData = $("#ticketsRequest").serialize();
						$.post({
							url: '/ajax/send_form.php',
							data: formData,
						})
						.done(function (sentData) {
							console.log( sentData );
							alert( sentData );
						});

					} else {
						alert( "ФОРМА ЗАПОЛНЕНА НЕ ПОЛНОСТЬЮ!" );
					}
				});


				/*$(".request-form-input").each( function (index, element){
				});*/

				reqFormTarget.find("#datepicker2").datepicker({
					dateFormat: "d M yy",
					showAnim: "fold",
				});

				reqFormTarget.find("#datepicker3").datepicker({
					dateFormat: "d M yy",
					showAnim: "fold",
				});

			}
		});
	}
}





function filterSortInit( sortCol ) {
	if( $('#filter').val() == "Y"){
		var data = $('#filter-form').serialize();
	} 
	if( sortCol ){
		var sortProperty = $( "#"+sortCol ).data("sort-prop");
		var sortOrder = $( "#"+sortCol ).data("sort-ord");
		data += "&sort=" + sortProperty + "&method=" + sortOrder;
	}
	$.post({
		url: $(location).attr('href'),
		data: data,
	})
	.done(function (data) {
		if (data) {
			$('#table-row-wrapper').html(data);
		}
		trainRowInit();
	});
	$(".sorting-header").removeClass("asc desc");
	if( sortCol ){
		var newSortOrder = (sortOrder=='asc') ? 'desc' : 'asc';
		$( "#"+sortCol ).data("sort-ord", newSortOrder);
		$( "#"+sortCol ).attr('data-sort-ord', newSortOrder);
		//$(".sorting-header").removeClass(sortOrder+" "+newSortOrder);
		$( "#"+sortCol ).addClass(newSortOrder);
	}
}

$(document).ready(function () {

	trainRowInit();

	$(".filter-form-input").change(function() {
		$("input[name=filter]").val("Y");
	});

	$("#datepicker").datepicker({
		dateFormat: "d M yy",
		showAnim: "fold",
		altField: "#dep-date-alt",
		altFormat: "yy-mm-dd",
		closeText: "Закрыть",
		prevText: "Пред",
		nextText: "След",
		currentText: "Сегодня",
		monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
		"Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
		monthNamesShort: [ "Января", "Февраля", "Марта", "Апреля", "Мая", "Июня",
		"Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря" ],
		dayNames: [ "воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота" ],
		dayNamesShort: [ "вск", "пнд", "втр", "срд", "чтв", "птн", "сбт" ],
		dayNamesMin: [ "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб" ],
		weekHeader: "Нед",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
	});

	$(".city-select").change(function() {
		var fromStation = $('select#station-from option:selected').text();
		var toStation = $('select#station-to option:selected').text();
		if( fromStation == toStation ){
			console.log("Жил человек рассеянный... ");
			$(".city-select").css("background","#ff000026");
			$("button.filter-form-input").hide();
		} else {
			$(".city-select").css("background","");
			$("button.filter-form-input").show();
		}
	});

	$(".sorting-header").click(function() {

		filterSortInit( $(this).attr("id") );

/*
		var sortProperty = $(this).data("sort-prop");
		var sortOrder = $(this).data("sort-ord");
		$.post({
			url: $(location).attr('href'),
			data: {'sort': sortProperty, 'method': sortOrder}
		})
		.done(function (data) {
			if (data) {
				$('#table-row-wrapper').html(data);
			}
			trainRowInit();
		});
		var newSortOrder = (sortOrder=='asc') ? 'desc' : 'asc';
		$(this).data("sort-ord", newSortOrder);
		$(this).attr('data-sort-ord', newSortOrder);
		$(".sorting-header").removeClass(sortOrder+" "+newSortOrder);
		$(this).addClass(newSortOrder);
*/
	});

	$("#searchBtn").click(function(e){
		e.preventDefault();
		if( $('#filter').val() == "Y"){
			filterSortInit();
		}
	});


});