<?php get_header('new'); ?>
<?php

/**
 * Template Name: Страница заказа
 */

$xml = simplexml_load_file(TEMPLATEPATH . '/includes/regions/dataTree.xml');
?>


<div id="main">
<div class="padding-w-170">

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
                        $i=0;
                        foreach ($regions as $country) {
                            $i++;
	                        echo "<option value='".$i.";".$country['region']."'>".$country['region']."</option>";

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
                <td><input type="text" name="amount" id="amount" class="colored" readonly tabindex="4" /></td>
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
                        $i=0;
                        foreach ($xml->departure->from as $from) {
                        $i++;
                            echo "<option value='".$i.";".$from."'>".$from."</option>";
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
                <td><input type="text" id="money-amount" name="money-amount"  class="colored" readonly tabindex="14"/></td>
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
                <td style="width:210px;" ><input type="text" id="category-val" name="category-val"  class="colored" readonly tabindex="15"/></td>
                <td style="width:220px;">
                    <div id="category"></div>
                </td>
            </tr>
            <tr>
                <td>Питание:</td>
                <td id="food_container" colspan="2">
                    <select data-placeholder="Выберите тип..." class="chzn-select" id="food" name="food" style="width:480px;" tabindex="16">
                        <?
                        echo "<option value='0'></option>";
                        $i=0;
                        foreach ($xml->food->type as $type) {
                            $i++;
                            echo "<option value='".$i.";".$type."'>$type</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table style="width:100%;" id="terms">
            <tr class="cbset">
                <td>
                    <input type="checkbox" name="box[]" id="check0" tabindex="17" /><label for="check0" onclick="togle_check(this)">-</label>1-я береговая линия
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check2" tabindex="18" /><label for="check2" onclick="togle_check(this)">-</label>Центр курортной зоны
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check4" tabindex="19" /><label for="check4" onclick="togle_check(this)">-</label>Корты
                </td>
                
            </tr>
            <tr class="cbset">
                <td>
                    <input type="checkbox" name="box[]" id="check1" tabindex="20" /><label for="check1" onclick="togle_check(this)">-</label>Для семей с детьми
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check3" tabindex="21" /><label for="check3" onclick="togle_check(this)">-</label>Wifi internet
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check5" tabindex="22" /><label for="check5" onclick="togle_check(this)">-</label>Сауна
                </td>
            </tr>
            <tr class="cbset">
            	<td>
                    <input type="checkbox" name="box[]" id="check6" tabindex="23" /><label for="check6" onclick="togle_check(this)">-</label>Ночная жизнь
                </td>
                <td>
                    <input type="checkbox" name="box[]" id="check7" tabindex="24" /><label for="check7" onclick="togle_check(this)">-</label>Анимация для взрослых
                </td>
             	 <td>
                    <input type="checkbox" name="box[]" id="check8" tabindex="25" /><label for="check8" onclick="togle_check(this)">-</label>Водные горки
                </td>
            </tr>
            <tr class="cbset">
             	<td>
                    <input type="checkbox" name="box[]" id="check9" tabindex="26" /><label for="check9" onclick="togle_check(this)">-</label>Анимация для детей
                </td>
                <td></td>
                <td></td>
            </tr>            
        </table>
    </div>
    <div class="subform">
       
        <table id="contact">
            <tr>
                <td style="width: 150px;">Имя:<small>*</small></td>
                <td><input type="text" id="fname" name="fname" style="width: 450px;" tabindex="27" /></td>
            </tr>
            <tr>
                <td style="width: 150px;">Фамилия:<small>*</small></td>
                <td><input type="text" id="lname" name="lname" style="width: 450px;" tabindex="27" /></td>
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
                    <p style="font-size:12px;margin:0;">Включить меня в рассылку новостей и специальных предложений</p>
                </td>
            </tr>

        </table>

    </div>
    <div id="error_form" class="error-form"></div>
    <div class="notes"><small>*</small> - поля, обязательны к заполнению</div>
   	<input type="submit" id="submit" value="Отправить запрос" style="margin-top: 15px; margin-bottom: 25px;" tabindex="32" />

</div><!-- form -->
<?php get_sidebar('order-form');?>
	</div></div>



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
			                "<input style=\"margin:0 0 0 5px; width: 46px; float:right; \" type=\"text\" class=\"age\" id=\"cb-" + i + "\" name=\"cb-" + i + "\" placeholder=\"Возраст\" tabindex=\"" + tab + "\" />"
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
            $("#amount").val(ui.values[ 0 ] + "-" + ui.values[ 1 ] + "  дн.");
        }
    });
    $("#amount").val($("#duration").slider("values", 0) + "-" + $("#duration").slider("values", 1) + "  дн.");

    reloadNewDatepicker();

    function reloadNewDatepicker() {
      	$( ".jqdate" ).datepicker({ dateFormat: "yy-mm-dd" });
    }

    $(".chzn-select").chosen({disable_search_threshold: 10});
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});
    
	function togle_check(obj) {
		if (obj.firstChild.innerHTML == '-') {
			obj.firstChild.innerHTML = '&#10004;';
			$(obj).css('background-color', '#1697E5 !important');
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

<?php get_footer('new'); ?>