<?php
/**
 * Template Name: Home Page Form
 */

$xml = simplexml_load_file(TEMPLATEPATH . '/includes/regions/dataTree.xml');
?>

<!DOCTYPE html>
<html>
<head>
    <title>SunnyHolidays</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8" />
    
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon_sunn.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/grid.css" />
    
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/chosen.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/jquery-ui.css" media="screen">
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-ui-1.9.1.custom.min.js"></script>
    <script type="text/javascript">
    	function placeholderForIE() {
    		if ($.browser.msie) {         //this is for only ie condition ( microsoft internet explore )
                $('input[type="text"][placeholder], textarea[placeholder]').each(function () {
                    var obj = $(this);

                    if (obj.attr('placeholder') != '') {
                        obj.addClass('IePlaceHolder');

                        if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
                            obj.val(obj.attr('placeholder'));
                        }
                    }
                });

                $('.IePlaceHolder').focus(function () {
                    var obj = $(this);
                    if (obj.val() == obj.attr('placeholder')) {
                        obj.val('');
                    }
                });

                $('.IePlaceHolder').blur(function () {
                    var obj = $(this);
                    if ($.trim(obj.val()) == '') {
                        obj.val(obj.attr('placeholder'));
                    }
                });
            }
    	}

    	$(document).ready(function () {
    		placeholderForIE();
	       	$("#submit").on('click', function () {
	       		$('#error_form').hide('fast');
                if (!checkmail($("#form #mail").val())) {
                    return false;
                } else {
                	childb = new Array();
                    $("#children-birthday input").each(function () {
						if (($(this).attr("id") != 'people') && ($(this).attr("id") != 'children_number'))
                        	childb.push($(this).val());
                    });
                    checkbox = new Array();
                    $("#terms input").each(function () {
                        if ($(this).is(':checked'))
                        	checkbox.push($(this).attr("id"));
                    });
                    $.post("/mail/", {

                            country:$("#form #country").val(),
                            period_from:$("#form #period_from").val(),
                            period_to:$("#form #period_to").val(),
                            duration:$("#form #amount").val(),
                            departure:$("#form #departure").val(),
                            people:$("#form #people").val(),
                            children_number:$("#form #children_number").val(),
                            "children_birthday[]":childb,
                            money_amount:$("#form #money-amount").val(),
                            category:$("#form #category-val").val(),
                            food:$("#form #food option:selected").val(),
                            "checkbox[]":checkbox,
                            last_name:$("#form #name").val(),
                            mail:$("#form #mail").val(),
                            phone:$("#form #phone").val(),
                            subscribe:$("#form #subscribe:checked").attr("id"),
                            comment:$("#form #comment").val()

                        },
                        function (data) {
                            if (data == 'error') {
                            	$('#error_form').html('Ошибка отправки. Проверьте, пожалуйста, все-ли поля заполнены.');
                                $('#error_form').show('fast');
                            } else {
                            	$(location).attr('href','/mail-success/');
                            }

                        });
                }
                function checkmail(value) {
                    var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
                    //var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)\b/;
                    if (!value.match(reg)) {
                        $('#error_form').html('Пожалуйста, проверьте свой введённый e-mail');
                        $('#error_form').show('fast');
                        $("#form #mail").focus();
                        return false;
                    }
                    return true;
                }

                
            });
        });

    </script>
</head>
<body>
<div id="main">
	<div class="container_12 clearfix">
		<div id="content">

<div id="form">
    <h2>Заявка на подбор тура</h2>
	<p>Доверьте подбор своего тура нам!</p>
	<p>Заполните поля предоставленной ниже формы. Наши специалисты подберут Вам варианты отдыха, максимально удовлетворяющего Вашим требованиям!</p>
    <div class="subform">
        
        <table>
            <tr>
                <td style="width: 150px;">Страна(курорт):<small>*</small></td>
                <td id="country_container" colspan="2">
                    <select multiple name="country" id="country" data-placeholder="Выберите страну/курорт..." class="chzn-select" style="width:480px;" tabindex="1">
                        <? $regions = get_regions();
                        foreach ($regions as $country) {
	                        echo "<option value='".$country['region']."'>".$country['region']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Период:<small>*</small></td>
                <td><input name="period_from" id="period_from" type="text" class="searching jqdate" placeholder="Заезд" style="width: 220px" tabindex="2" /></td>
                <td><input name="period_to" id="period_to" type="text" class="searching jqdate" placeholder="Выезд" style="width: 220px" tabindex="3" /></td>
            </tr>
            <tr>
                <td>Продолжительность:<small>*</small></td>
                <td><input type="text" name="amount" id="amount" style="color:#90B500; font-weight:bold; width: 220px" readonly tabindex="4" /></td>
                <td style="width: 220px">
                    <div id="duration"></div>
                </td>
            </tr>
            <tr>
                <td>Выезд/вылет из:<small>*</small></td>
                <td id="departure_container" colspan="3">
                    <select multiple data-placeholder="Выберите место..." class="chzn-select" id="departure" style="width:480px;" tabindex="5">
                        <?
                        echo "<option value='0'></option>";
                        foreach ($xml->departure->from as $from) {

                            echo "<option value='$from'>$from</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 150px;">Взрослых / Детей:<small>*</small></td>
                <td id="children-birthday" colspan="2">
                    <input type="text" name="people" id="people" style="width: 44px; float: left;" readonly tabindex="7" />
                    <input type="text" name="children_number" id="children_number" style="width: 44px; float: left; margin-left: 1px;" readonly tabindex="8" />
                </td>
            </tr>
            <tr>
                <td style="width: 150px;">Бюджет:<small>*</small></td>
                <td><input type="text" id="money-amount" name="money-amount" style="color:#90B500; font-weight:bold; width:220px;" readonly tabindex="14"/></td>
                <td style="width:220px;" >
                    <div id="money"></div>
                </td>
            </tr>
        </table>
    </div>
    <div class="subform">
        <table>
            <tr>
                <td style="width: 150px;">Категория:<small>*</small></td>
                <td style="width:220px;"><input type="text" id="category-val" name="category-val" style="color:#90B500; font-weight:bold; width:220px;" readonly tabindex="15"/></td>
                <td >
                    <div id="category"></div>
                </td>
            </tr>
            <tr>
                <td>Питание:</td>
                <td id="food_container" colspan="2">
                    <select data-placeholder="Выберите тип..." class="chzn-select" id="food" name="food" style="width:480px;" tabindex="16">
                        <?
                        echo "<option value='0'></option>";
                        foreach ($xml->food->type as $type) {

                            echo "<option value='$type'>$type</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table style="width:100%;" id="terms">
            <tr class="cbset">
                <td>
                    <input type="checkbox" name="box[]" id="check1" tabindex="17" /><label for="check1" onclick="togle_check(this)">-</label>1-я береговая линия
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check3" tabindex="18" /><label for="check3" onclick="togle_check(this)">-</label>Центр курортной зоны
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check5" tabindex="19" /><label for="check5" onclick="togle_check(this)">-</label>Корты
                </td>
                
            </tr>
            <tr class="cbset">
                <td>
                    <input type="checkbox" name="box[]" id="check2" tabindex="20" /><label for="check2" onclick="togle_check(this)">-</label>Для семей с детьми
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check4" tabindex="21" /><label for="check4" onclick="togle_check(this)">-</label>Wifi internet
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check6" tabindex="22" /><label for="check6" onclick="togle_check(this)">-</label>Сауна
                </td>
            </tr>
            <tr class="cbset">
            	<td>
                    <input type="checkbox" name="box[]" id="check7" tabindex="23" /><label for="check7" onclick="togle_check(this)">-</label>Ночная жизнь
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check8" tabindex="24" /><label for="check8" onclick="togle_check(this)">-</label>Анимация для взрослых
                </td>
             	 <td>
                    <input type="checkbox" name="box[]" id="check9" tabindex="25" /><label for="check9" onclick="togle_check(this)">-</label>Водные горки
                </td>
            </tr>
            <tr class="cbset">
             	<td>
                    <input type="checkbox" name="box[]" id="check10" tabindex="26" /><label for="check10" onclick="togle_check(this)">-</label>Анимация для детей
                </td>
                <td></td>
                <td></td>
            </tr>            
        </table>
    </div>
    <div class="subform">
       
        <table id="contact">
            <tr>
                <td style="width: 150px;">Имя и Фамилия:<small>*</small></td>
                <td><input type="text" id="name" name="name" style="width: 450px;" tabindex="27" /></td>
            </tr>
            <tr>
                <td>E-mail адрес:<small>*</small></td>
                <td><input type="text" id="mail" name="mail" style="width: 450px;" tabindex="28" /></td>
            </tr>
            <tr>
                <td>Телефон:<small>*</small></td>
                <td><input type="text" id="phone" name="phone" style="width: 450px;" tabindex="29" /></td>
            </tr>
            <tr>
                <td>Комментарий:</td>
                <td><textarea id="comment" name="comment" style="width: 450px;" tabindex="30"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input style="float:left; margin-right:5px;" type="checkbox" id="subscribe" name="subscribe" tabindex="31"/>
                    <p style="font-size:12px;padding:2px 0 0 0;margin:0;">Включить меня в рассылку новостей и специальных предложений</p>
                </td>
            </tr>

        </table>

    </div>
    <div id="error_form" class="error-form"></div>
    <div class="notes"><small>*</small> - поля, обязательны к заполнению</div>
   	<input type="submit" id="submit" value="Отправить запрос" style="margin-top: 15px; margin-bottom: 25px;" tabindex="32" />

</div><!-- form -->
		</div>
	</div>
</div>


<script type="text/javascript">
    $(".cbset").buttonset();
    $('#people').spinner({
        			min: 0,
        			max: 5,
        			editable: false
    			});
	
    $('#children_number').spinner({
		min: 0,
		max: 5,
		editable: false,
		spin: function () { 
				setTimeout(function() {
			    	$("input[id*=cb-]").remove();
			        for (var i = 0; i < $("#children_number").val(); i++) {
				        tab = 13 - i;
			            $("#children-birthday").append(
			                "<input style=\"margin:0 0 0 5px; width: 46px; float:right; \" type=\"text\" id=\"cb-" + i + "\" name=\"cb-" + i + "\" placeholder=\"Возраст\" tabindex=\"" + tab + "\" />"
			            );
			        }
					placeholderForIE();
				}, 100);
			}
	});

    $("#category").slider({
        range:"min",
        min:1,
        max:5,
        value:3,
        step:1,
        animate:"fast",
        slide:function (event, ui) {
            $("#category-val").val(ui.value + "*");
        }
    });
    $("#category-val").val($("#category").slider("value") + "*");

    $("#money").slider({
        range:"min",
        min:100,
        max:10000,
        value:500,
        step:50,
        animate:"fast",
        slide:function (event, ui) {
            $("#money-amount").val("до $" + ui.value);
        }
    });
    $("#money-amount").val("до $" + $("#money").slider("value"));

    $("#duration").slider({
        range:true,
        min:1,
        max:21,
        values:[ 7, 14 ],
        animate:"fast",
        slide:function (event, ui) {
            $("#amount").val(ui.values[ 0 ] + " - " + ui.values[ 1 ] + "  дней");
        }
    });
    $("#amount").val($("#duration").slider("values", 0) + " - " + $("#duration").slider("values", 1) + "  дней");

    reloadNewDatepicker();

    function reloadNewDatepicker() {
      	$( ".jqdate" ).datepicker({ dateFormat: "yy-mm-dd" });
    }

    $(".chzn-select").chosen({disable_search_threshold: 10});
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});
    
	function togle_check(obj) {
		if (obj.firstChild.innerHTML == '-') {
			obj.firstChild.innerHTML = '&#10004;';
			$(obj).css('background-color', '#AED21D !important');
			setTimeout(function() {
				$('#' + $(obj).attr('for')).attr('checked', true);
			}, 100 );
		} else if (obj.firstChild.innerHTML == '✔') {
			obj.firstChild.innerHTML = '-';
			$(obj).css('background-color', '#E6E6E6 !important');
			setTimeout(function() {
				$('#' + $(obj).attr('for')).attr('checked', false);
			}, 100 );
		}
	}
</script>

</body>
</html>
