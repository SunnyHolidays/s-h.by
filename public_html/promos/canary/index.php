<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no"/>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Канарские Острова – Отпуск круглый год!</title>
    <link href="./css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
function getPlace($string)
{
    $place = mb_split('\\\\', $string);
    return trim($place[1]);
}

function getPlaces(&$preloaded, $page = 1)
{
    $data = file_get_contents('http://www.itaka.pl/ru/strony/4466.php?currpage=' . $page . '&destinations[]=fuerteventura&destinations[]=gran-canaria&destinations[]=lanzarote&destinations[]=teneryfa&adults=2&childs=0&child_age[]=26.07.2010&pricetype=all&order=price|asc');
    $data = json_decode($data, true);
    if (!empty($preloaded)) {
        $preloaded['results'] = array_merge($preloaded['results'], $data['results']);
    } else {
        $preloaded = $data;
    }
    if ($data['has_more'] === true) {
        $page++;
        getPlaces($preloaded, $page);
    }
    return true;
}

function groupArrayByField(array $arrays, $field, $filter)
{

    $groupedArray = array();
    foreach ($arrays as $array) {
        if (in_array($array['productCode'], $filter)) {
            $id = $array[$field];
            if (!isset($groupedArray[$id])) {
                $groupedArray[$id] = array();
            }
            $groupedArray[$id][] = $array;
        }
    }
    return $groupedArray;
}

$preloaded = array();
getPlaces($preloaded, 1);
foreach ($preloaded['results'] as $index => $place) {
    $preloaded['results'][$index]['destinationSmall'] = getPlace($place['destination']);
}
$preloadedProducts = array(
    'FSBAVA', 'TFSAREN', 'TFSBASA', 'TFSISLA', 'TFSLAGO', 'TFSNINA', 'TFSPUER', 'TFSORTA', 'TFSFLAM', 'TFSPRIN', 'TFSSOTE',
    'FUECCBR', 'FUETARO', 'FUEPARA', 'FUEPAJA', 'FUERIOC', 'FUECALE', 'FUEJARE', 'FUEALOE',
    'LPAMOGA', 'LPAMARG', 'LPAMIRA', 'LPABONI', 'LPAKOAL', 'LPAVILA', 'LPAGREO',
    'ACELANZ', 'ACEGRAN', 'ACEBELI', 'ACEZOCO', 'ACEISLA', 'ACENAZA'

);
$preloaded = groupArrayByField($preloaded['results'], 'destinationSmall', $preloadedProducts);
$bufArray = array();
$bufArray['Тенерифе'] = $preloaded['Тенерифе'];
$bufArray['Фуэртевентура'] = $preloaded['Фуэртевентура'];
$bufArray['Гран-Канария'] = $preloaded['Гран-Канария'];
$bufArray['Лансароте'] = $preloaded['Лансароте'];
$preloaded = $bufArray;
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
            <div class="slogan"><span>Канарские Острова</span> <br>– Отпуск круглый год!</div>
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
                <div class="row menu">
                    <? foreach ($preloaded as $index => $places): ?>
                        <? $price = $places[0]['price']; ?>
                        <a class="nav-links" href="#<?= $index ?>"><?= $index ?><br> <span>(от <?= $price ?> PLN)</span></a>
                    <? endforeach; ?>
                    <?
                    $firstPlace = reset($preloaded);
                    $anchor = $firstPlace[0]['destinationSmall'];
                    ?>
                    <a class="scroll" href="#<?= $anchor ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row screen-2 clearfix">
        <div class="inner-content">
            <? foreach ($preloaded as $index => $places): ?>
                <ul class="places" id="<?= $index ?>">
                    <?
                    echo "<h1><a href='#$index'>$index</a></h1>";
                    ?>
                    <? foreach ($places as $place): ?>

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
                                    <?= implode(', ', $place['assetsList']) ?>
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
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
            <? endforeach; ?>
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
<link href="./css/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link href="./css/liMarquee.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="./js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="./js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="./js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="./js/jquery.liMarquee.js"></script>
<script>
    $(function () {
        $('#partners-sprite').liMarquee({
            direction: 'left',
            loop: -1,
            scrollamount: 50,
            circular: true,
            drag: true
        });
        $(".countdown").countdown({
            image: "images/digits.png",
            format: "dd:hh:mm:ss",
            digitWidth: 29,
            digitHeight: 39,
            endTime: new Date(2015, 8, 7)
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.open-gallery', function (e) {
            e.preventDefault();
            var links = $.parseJSON($(this).attr('data-images'));
            var images = [];
            $.each(links, function (index, link) {
                images.push({href: link});
            });
            $.fancybox.open(images);
        });
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 30, scrollLeft: target.offset().left - 10
                    }, 500);
                    return false;
                }
            }
        });
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
    (function () {
        var widget_id = '83LmxogPFk';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();
</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>