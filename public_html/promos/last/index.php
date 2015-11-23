<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no"/>
    <title>Туры Дня!</title>
</head>
<body>
<?
function declOfNum($number, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

$preloaded = file_get_contents('http://www.itaka.pl/ru/strony/4466.php?filter=lastminute&currpage=1&pricetype=all&adults=2&childs=0&child_age[]=03.08.2010&order=price|asc');
$preloaded = json_decode($preloaded, true);
?>
<div class="container">
    <header class="row">
        <div class="inner-content">
            <div class="half-separator">
                <a href="/" class="logo">
                    <img src="./images/logo.png">
                </a>
            </div>
            <div class="half-separator">
                <div class="contacts">
                    <div class="row">
                        <span class="address">
                            г. Гродно, ул. Буденного, 48а-46 (3 этаж)
                        </span>
                        <span class="skype">
                            <a href="skype:sunnyholidays.by?chat">sunnyholidays.by</a>
                        </span>
                         <span class="main-phone">
                        8 (0152) 72-00-22 | 8 (0152) 75-71-67
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="row screen-1 clearfix">
        <div class="inner-content">
            <div class="slogan">
                <span class="big">Туры Дня!</span>
                <br>Каждый день новые спецпредложения
                <br>по самым низким ценам
                <br>Сегодня
                <span><?= $preloaded['count'] ?></span> <? echo declOfNum($preloaded['count'], array('тур', 'тура', 'туров')); ?>
                от <span><?= $preloaded['results'][0]['price'] ?> PLN</span> за двоих.
            </div>
            <div class="promo">До конца акции осталось:<br>

                <div class="countdown">
                    <div class="countdown-footer">
                        <span>дней</span>
                        <span>часов</span>
                        <span>минут</span>
                        <span>секунд</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row search-wrapper">
            <div class="inner-content">
                <form>
                    <div class="col">
                        <label for="departures">Вылет из:</label>
                        <select id="departures" name="departures">
                            <option value="KTW,KCW">Катовице</option>
                            <option value="PZP,POZ">Познань</option>
                            <option value="WZZ,WAW">Варшава</option>

                        </select>
                    </div>
                    <div class="col">
                        <label for="destination">Прилет в:</label>
                        <select id="destination" name="destination">
                            <option value="egipt">Египет</option>
                            <option value="turcja">Турция</option>
                            <option value="grecja">Греция</option>
                            <option value="hiszpania">Испания</option>
                            <option value="wlochy">Италия</option>
                            <option value="cypr">Кипр</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="duration">Продолжительность:</label>
                        <select id="duration" name="duration">
                            <option value="short">0-6 дней</option>
                            <option value="mid1">6-9 дней</option>
                            <option value="mid2">9-12 дней</option>
                            <option value="long">13-15+ дней</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="date">Период вылета:</label>
                        <input type="text" name="date" id="date">
                    </div>
                    <div class="col">
                        <label for="participants">Пассажиры:</label>

                        <div id="participants" class="input dropdown">
                            <span class="adults">0</span>
                            <span class="children">0</span>
                        </div>
                        <div class="dropdown-content">
                            <div class="col">
                                <label for="children">Взрослых и детей:</label><br>
                                <select id="adults" name="adults" class="number">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select id="children" name="children" class="number">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col" id="children_ages">
                                <div class="full-age">Возраст детей</div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button>Подобрать туры</button>
                    </div>
                </form>
                <div class="row menu">
                    <a class="scroll" href="#"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row screen-2 clearfix">
        <div class="inner-content">
            <ul class="places">
                <?
                foreach ($preloaded['results'] as $place):
                    ?>
                    <li class="clearfix">
                        <a href="#" class="open-gallery"
                           data-images='<?= json_encode(explode(',', $place['searchGallery']), 64) ?>'></a>
                        <img src="http://www.itaka.pl<?= $place['photo'] ?>">

                        <div class="info">
                            <div class="rating"><?= $place['rating'] ?></div>
                        </div>
                        <? $params = '?sd=*0&ed=30.04.2016&sb=A&sr=DBL&t=ITAK&st=PA&sp=4&drf=7&drt=15&ca=A&a=2&hc=' . $place['productCode'] ?>
                        <a href="/tours-poland/?ep3[]=<?= urlencode($params) ?>"
                           target="_blank">
                            <div class="hotel">
                                <h3 class="hotel-name"><?= $place['title'] ?><sup><?= $place['stars'] ?></sup>
                                </h3>
                                <span class="place"><?= $place['destination'] ?></span>
                                <span class="tags">
                                    <?= is_array($place['assetsList']) ? implode(', ', $place['assetsList']) : null ?>
                                </span>

                                <span class="separator"></span>
                                <?
                                $price = 0;
                                if ($place['percentItakaHit'] > 0) {
                                    $price = number_format(preg_replace('/\D/', '', $place['ymaxPriceItakaHit']) * 2, 0, '.', ' ');
                                }
                                ?>
                                <div class="text-center">
                                    <div class="prices">
                                        от
                                        <? if ($price !== 0): ?><span class="old"><?= $price ?></span><? endif; ?>
                                        <span class="current"><?= $place['price'] ?> PLN</span>
                                        за двоих
                                        <? if ($price !== 0): ?><sup>-<?= $place['percentItakaHit'] ?>
                                            %</sup><? endif; ?>
                                    </div>
                                </div>
                            </div>
                    </li>
                <? endforeach; ?>
            </ul>
            <a href="#" class="more">Ещё!</a>
        </div>
    </div>
    <div class="screen-3 row">
        <div class="inner-content">
            <h1>У нас можно забронировать туры:</h1>

            <div id='partners-sprite'>
                <a href="#" class="sprite-alfastar"></a>
                <a href="#" class="sprite-anex-tour"></a>
                <a href="#" class="sprite-biblio-globus"></a>
                <a href="#" class="sprite-coral-travel"></a>
                <a href="#" class="sprite-eco-tour-6"></a>
                <a href="#" class="sprite-exim"></a>
                <a href="#" class="sprite-intercity"></a>
                <a href="#" class="sprite-intourist"></a>
                <a href="#" class="sprite-itaka"></a>
                <a href="#" class="sprite-join-up"></a>
                <a href="#" class="sprite-mouzenidis-travel-logo"></a>
                <a href="#" class="sprite-natalie-tours"></a>
                <a href="#" class="sprite-pegas-touristik"></a>
                <a href="#" class="sprite-rosting"></a>
                <a href="#" class="sprite-sanrayz-tur"></a>
                <a href="#" class="sprite-sunfun"></a>
                <a href="#" class="sprite-sunmar"></a>
                <a href="#" class="sprite-tez-tour"></a>
                <a href="#" class="sprite-top-tour"></a>
                <a href="#" class="sprite-troyka"></a>
                <a href="#" class="sprite-tui"></a>
                <a href="#" class="sprite-turtess"></a>
                <a href="#" class="sprite-tusson-voyage"></a>
                <a href="#" class="sprite-ukrest"></a>
                <a href="#" class="sprite-ecco-holiday"></a>
                <a href="#" class="sprite-citron"></a>
                <a href="#" class="sprite-beefree"></a>
                <a href="#" class="sprite-7-islands"></a>
                <a href="#" class="sprite-grecos"></a>
                <a href="#" class="sprite-wezyr"></a>
                <a href="#" class="sprite-rainbowtours"></a>
                <a href="#" class="sprite-neckermann"></a>
                <a href="#" class="sprite-net-holiday"></a>
            </div>
        </div>
    </div>
    <div class="screen-4 row">
        <div class="inner-content">
            <div class="map">
                <script type="text/javascript" charset="utf-8"
                        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=VomZwvrU1sRkcJwHXuvhZkfYIYKPLAag&width=702&height=350"></script>
            </div>
            <div class="contacts2">
                <h3>Телефоны для справок:</h3>

                <div class="phones">
                    <div class="half-separator">
                        <span>8 (033) 325 29 50</span>
                        <span>8 (029) 663 34 48</span>
                    </div>
                    <div class="half-separator">
                        <span>8 (029) 582 86 67</span>
                        <span>8 (029) 633 35 96</span>
                    </div>
                </div>

                <h3>Skype:</h3>
                <span class="skype"><a href="skype:sunnyholidays.by?chat">sunnyholidays.by</a></span>

                <h3>Наш адрес:</h3>
                <span>г. Гродно, ул. Буденного, 48а-46 (3 этаж)</span>
            </div>
        </div>
    </div>
</div>
</body>
<link href="./css/style.css" rel="stylesheet" type="text/css">
<link href="./css/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link href="./css/liMarquee.css" rel="stylesheet" type="text/css">
<link href="./css/select2.css" rel="stylesheet" type="text/css">
<link href="./css/daterangepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="./js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="./js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="./js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="./js/jquery.liMarquee.js"></script>
<script type="text/javascript" src="./js/select2.full.min.js"></script>
<script type="text/javascript" src="./js/moment.min.js"></script>
<script type="text/javascript" src="./js/jquery.daterangepicker.js"></script>
<script>
    $(function () {
        var search_form = $('.search-wrapper .inner-content');
        var form_pos = search_form.offset().top;
        $(window).scroll(function () {
            var top = $(document).scrollTop();
            if (top < form_pos) {
                search_form.removeClass("menu-fix");
     
            }
            else {
                search_form.addClass("menu-fix");

            }
        });
        var date1 = moment().format('DD.MM.YYYY');
        var date2 = '31.05.2016';
        $('#date').dateRangePicker({
            format: 'DD.MM.YYYY',
            separator: ' - '
        }).bind('datepicker-change', function (event, obj) {
            date1 = moment(obj.date1).format('DD.MM.YYYY');
            date2 = moment(obj.date2).format('DD.MM.YYYY');
        });
        $('select').select2({minimumResultsForSearch: Infinity, allowClear: true, placeholder: 'Без разницы'});
        $('select#duration').select2({minimumResultsForSearch: Infinity, allowClear: true, placeholder: 'Любое'});
        $('#adults, #children').select2({minimumResultsForSearch: Infinity});

        var children_count = parseInt($('#children').val());
        $('.children').text(children_count);
        $('.adults').text($('#adults').val());
        if (children_count > 0) {
            $('.full-age').show();
        }
        else {
            $('.full-age').hide();
        }
        for (var i = 1; i <= children_count; i++) {
            var label = $('<label>').attr('for', 'child_age-' + i).text('Ребенок ' + i + ':').after($('<br>'));
            var select = $('<select>').attr('id', 'child_age-' + i).attr('name', 'child_age-' + i).addClass('number');
            for (var j = 1; j <= 17; j++) {
                select.append($('<option>').attr('value', j).text(j));
            }
            $('#children_ages').append($('<div>').addClass('col').append(label).append(select));
            $('#child_age-' + i).select2({minimumResultsForSearch: Infinity});
        }
        $('#adults').on('change', function () {
            $('.adults').text($(this).val());
        });
        $('#children').on('change', function () {
            var new_children_count = parseInt($(this).val());
            if (new_children_count > children_count) {
                for (var i = children_count + 1; i <= new_children_count; i++) {
                    var label = $('<label>').attr('for', 'child_age-' + i).text('Ребенок ' + i + ':').after($('<br>'));
                    var select = $('<select>').attr('id', 'child_age-' + i).attr('name', 'child_age-' + i).addClass('number');
                    for (var j = 1; j <= 17; j++) {
                        select.append($('<option>').attr('value', j).text(j));
                    }
                    $('#children_ages').append($('<div>').addClass('col').append(label).append(select));
                    $('#child_age-' + i).select2({minimumResultsForSearch: Infinity});
                }
            }
            if (new_children_count < children_count) {
                for (var i = children_count; i > new_children_count; i--) {
                    $('select#child_age-' + i).parent('.col').remove();
                }
            }
            children_count = new_children_count;
            $('.children').text(children_count);
            if (children_count > 0) {
                $('.full-age').show();
            }
            else {
                $('.full-age').hide();
            }
        });
        $('.dropdown, .dropdown span').on('click', function () {
            $.content = $(this).parent().find('.dropdown-content');
            $.content.toggle();
        });
        $(document).click(function (e) {
            if (typeof $.content != 'undefined'
                && $.content.is(":visible")
                && -(
                    $(e.target).parent('form .col').find('.dropdown').length == 0
                    && $(e.target).parents('.dropdown-content').length == 0
                )
            ) {
                $.content.hide();
            }
        });
        $('#partners-sprite').liMarquee({
            direction: 'left',
            loop: -1,
            scrollamount: 50,
            circular: true,
            drag: true
        });
        var today = new Date();
        var poland = new Date(today.getTime() + (today.getTimezoneOffset() + 120) * 60 * 1000);
        poland = new Date(poland.getUTCFullYear(), poland.getMonth(), poland.getDate() + 1, 0, 0, 0, 0);
        today = new Date(poland.getTime() - (poland.getTimezoneOffset() + 120) * 60 * 1000);

        $(".countdown").countdown({
            image: "images/digits.png",
            format: "dd:hh:mm:ss",
            digitWidth: 29,
            digitHeight: 39,
            endTime: today
        });

        $(document).on('click', '.open-gallery', function (e) {
            e.preventDefault();
            var links = $.parseJSON($(this).attr('data-images'));
            var images = [];
            $.each(links, function (index, link) {
                images.push({href: link});
            });
            $.fancybox.open(images);
        });

        var page = <?=$preloaded['page']?>;
        var destinations = [];
        var departures = [];
        var duration;
        var child_age = [];
        var children = 0;
        var pricetype = 'all';
        var adults = 2;

        function getPlaces(reload) {
            $.ajax({
                url: "./getJsonData.php",
                data: {
                    filter: 'lastminute',
                    date_from: date1,
                    date_to: date2,
                    currpage: page + 1,
                    adults: adults,
                    childs: children,
                    child_age: child_age,
                    pricetype: pricetype,
                    destinations: destinations,
                    duration: duration,
                    departures: departures,
                    order: 'price|asc'
                }
            }).success(function (data) {
                if (reload) {
                    $('.places').html(null);
                }
                addPlaces(data);
                if (data.has_more == false) {
                    $('.more').fadeOut();
                }
                else {
                    $('.more').fadeIn();
                    page++;
                }

            });
        }

        $('.more').on('click', function (e) {
            e.preventDefault();
            getPlaces();
        });

        $('form').on('submit', function (e) {
            e.preventDefault();
            var country = $(this).find('#destination').val();
            var airport = $(this).find('#departures').val();
            var days = $(this).find('#duration').val();
            children = parseInt($(this).find('#children').val());
            adults = parseInt($(this).find('#adults').val());
            duration = $(this).find('#duration').val();

            page = 0;
            if (country != '' && country != null) {
                destinations = [country];
            }
            else {
                destinations = [];
            }
            if (airport != '' && airport != null) {
                departures = [airport];
            }
            else {
                departures = [];
            }
            if (children + adults == 1) {
                pricetype = 'person';
            }
            else {
                pricetype = 'all';
            }
            child_age = [];
            $('select[id*="child_age-"] option:selected').each(function (index) {
                child_age.push(moment().subtract($(this).val(), 'year').format('DD.MM.YYYY'));
            });
            getPlaces(true);
            $('html,body').animate({
                scrollTop: $('.search-wrapper').offset().top, scrollLeft: $('.search-wrapper').offset().left
            }, 500);
        });
        $('.scroll').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: $('.search-wrapper').offset().top, scrollLeft: $('.search-wrapper').offset().left
            }, 500);
        });
        function addPlaces(data) {
            <? $params = '?sd=*0&ed=30.04.2016&sb=A&sr=DBL&t=ITAK&st=PA&sp=4&drf=7&drt=15&ca=A&a=2&hc=' ?>
            var params = '<?= urlencode($params) ?>';
            $.each(data.results, function (index, place) {
                var tags = '';
                if (Object.keys(place.assetsList).length > 0) {
                    tags = place.assetsList.join(", ");
                }
                var price = place.ymaxPriceItakaHit;
                if (place.percentItakaHit > 0) {
                    price = parseInt(price.replace('&nbsp;', '')) * adults;
                    price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                }
                var current = '<span class="current">' + place.price + ' PLN</span>';

                var old = '';
                var discount = '';

                if (price !== 0) {
                    old = '<span class="old">' + price + '</span>';
                    discount = '<sup>-' + place.percentItakaHit + '%</sup>'
                }

                $('.places').append(
                    $('<li>').hide().addClass('clearfix')
                        .append(
                        $('<a>').attr('href', '#').attr('data-images', JSON.stringify(place.searchGallery.split(','))).addClass('open-gallery')
                    )
                        .append(
                        $('<img>').attr('src', 'http://www.itaka.pl' + place.photo)
                    )
                        .append(
                        $('<div>').addClass('info').append($('<div>').addClass('rating').html(place.rating))
                    )
                        .append(
                        $('<a>').attr('href', '/tours-poland/?ep3[]=' + params + place.productCode).attr('target', '_blank')
                            .append(
                            $('<div>').addClass('hotel')
                                .append(
                                $('<h3>').addClass('hotel-name').html(place.title + '<sup>' + place.stars + '</sup>')
                            )
                                .append(
                                $('<span>').addClass('place').html(place.destination)
                            )
                                .append(
                                $('<span>').addClass('tags').html(tags)
                            )
                                .append(
                                $('<span>').addClass('separator')
                            )
                                .append(
                                $('<div>').addClass('text-center')
                                    .append(
                                    $('<div>').addClass('prices').html('от ' + old + ' ' + current + ' за двоих' + discount)
                                )
                            )
                        )
                    )
                        .fadeIn()
                );

            });
        }
    });
</script>

<script type="text/javascript">//<![CDATA[

    // Google Analytics for WordPress by Yoast v4.3.3 | http://yoast.com/wordpress/google-analytics/

    var _gaq = _gaq || [];

    _gaq.push(['_setAccount', 'UA-37852570-1']);

    _gaq.push(['_trackPageview']);

    (function () {

        var ga = document.createElement('script');

        ga.type = 'text/javascript';

        ga.async = true;

        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';


        var s = document.getElementsByTagName('script')[0];

        s.parentNode.insertBefore(ga, s);

    })();

    //]]></script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    /*    (function () {
     var widget_id = '83LmxogPFk';
     var s = document.createElement('script');
     s.type = 'text/javascript';
     s.async = true;
     s.src = '//code.jivosite.com/script/widget/' + widget_id;
     var ss = document.getElementsByTagName('script')[0];
     ss.parentNode.insertBefore(s, ss);
     })();*/
</script>
<!-- {/literal} END JIVOSITE CODE -->
</html>