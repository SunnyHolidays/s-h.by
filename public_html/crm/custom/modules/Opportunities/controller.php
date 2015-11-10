<?php
mb_internal_encoding("UTF-8");
include_once('custom/modules/Opportunities/tbs_class.php');
include_once('custom/modules/Opportunities/tbs_plugin_opentbs.php');

class CustomOpportunitiesController extends SugarController
{
    public function num_propis($num)
    {
        $m = array(
            array('ноль'),
            array('-', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'),
            array('-', '-', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто'),
            array('-', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот'),
            array('-', 'одна', 'две')
        );

        $r = array(
            array('...ллион', '', 'а', 'ов'), // используется для всех неизвестно больших разрядов
            array('тысяч', 'а', 'и', ''),
            array('миллион', '', 'а', 'ов'),
            array('миллиард', '', 'а', 'ов'),
            array('триллион', '', 'а', 'ов'),
            array('квадриллион', '', 'а', 'ов'),
            array('квинтиллион', '', 'а', 'ов')
        );
        if ($num == 0) return $m[0][0];
        $o = array();
        foreach (array_reverse(str_split(str_pad($num, ceil(strlen($num) / 3) * 3, '0', STR_PAD_LEFT), 3)) as $k => $p) {
            $o[$k] = array();

            foreach ($n = str_split($p) as $kk => $pp) if (!$pp) continue; else switch ($kk) {
                case 0:
                    $o[$k][] = $m[4][$pp];
                    break;
                case 1:
                    if ($pp == 1) {
                        $o[$k][] = $m[2][$n[2]];
                        break 2;
                    } else$o[$k][] = $m[3][$pp];
                    break;
                case 2:
                    if (($k == 1) && ($pp <= 2)) $o[$k][] = $m[5][$pp]; else$o[$k][] = $m[1][$pp];
                    break;
            }
            $p *= 1;
            if ($p && $k)switch (true) {
                case preg_match("/^[1]$|^\\d*[0,2-9][1]$/", $p):
                    $o[$k][] = $r[$k][0] . $r[$k][1];
                    break;
                case preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/", $p):
                    $o[$k][] = $r[$k][0] . $r[$k][2];
                    break;
                default:
                    $o[$k][] = $r[$k][0] . $r[$k][3];
                    break;
            }
            $o[$k] = implode(' ', $o[$k]);
        }
        $num = implode(' ', array_reverse($o));
        return mb_strtoupper(mb_substr($num, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($num, 1, mb_strlen($num), 'UTF-8');
    }

    public function action_ExportToDoc()

    {
        $recordID = $_REQUEST['record'];
        $opportunity = new Opportunity();
        $opportunity->retrieve($recordID);
        $show=0;
        $month = array("января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
        $ContractNum = $opportunity->contract_num_c;
        $ContractDate = explode('-',$opportunity->date_contract_c);
        $ContractDate1 = "«" . $ContractDate[0] . "» " . $month[$ContractDate[1] - 1] . " " . $ContractDate[2] . " г.";
        $ContractDate2 = str_replace("-", ".",$opportunity->date_contract_c);
        $ContractDate3 = $ContractDate[0] . " " . $month[$ContractDate[1] - 1] . " " . $ContractDate[2] . " г.";
        $participants = $opportunity->get_linked_beans('part_participants_opportunities');
        $participants = array_reverse($participants);
        $FirstParticipantName = $participants[0]->snamerus . " " . $participants[0]->fnamerus . " " . $participants[0]->mnamerus;

        $AmountParticipants = count($participants);
        if (($AmountParticipants % 100 < 12 or $AmountParticipants % 100 > 14)and($AmountParticipants%10 > 1 and $AmountParticipants%10 < 5)) {
            $AmountParticipants = $AmountParticipants . " человека";
        } else {
            $AmountParticipants = $AmountParticipants . " человек";
        }
        $AmountOfServices = $opportunity->amount_of_services_c;
        $AmountOfServicesText = $this->num_propis($AmountOfServices);
        $AmountAndRate = $opportunity->amount * $opportunity->rate_c;
        $AmountAndRateText = $this->num_propis($AmountAndRate);
        $Amount = $opportunity->amount;

        $Prepayment = $opportunity->prepayment_c;
        $PrepaymentAndRate=$opportunity->prepayment_c * $opportunity->rate_c;
        $PrepaymentAndRateText=$this->num_propis($PrepaymentAndRate);
        $AmountRemains=$Amount-$Prepayment;
        $AmountRemainsAndRate=$AmountAndRate-$PrepaymentAndRate;
        $AmountRemainsAndRateText=$this->num_propis($AmountRemainsAndRate);

        $currency = new Currency();
        $currency->retrieve($opportunity->currency_id);
        $Currency = $currency->name;
        $FullPaymentDate =str_replace("-", ".", $opportunity->full_payment_date_c);
        $FirstParticipantPassport = $participants[0]->passport_num;
        $FirstParticipantPassportDate = str_replace("-", ".", $participants[0]->passport_date);
        $FirstParticipantPassportWho = $participants[0]->passport_who;
        $FirstParticipantAdress = $participants[0]->adress_c;
        $FirstParticipantNameShort = $participants[0]->snamerus . " " . mb_substr($participants[0]->fnamerus, 0, 1, 'UTF-8') . "." . mb_substr($participants[0]->mnamerus, 0, 1, 'UTF-8') . ".";
        $Country = $GLOBALS['app_list_strings']['countries_dom'][$opportunity->country_c];
        $Country = mb_substr($Country, 0, 1, 'UTF-8') . mb_strtolower(mb_substr($Country, 1, mb_strlen($Country), 'UTF-8'), 'UTF-8');
        $Resort = $opportunity->resort_c;
        $Itinerary = $opportunity->airport_dep_c . " – " . $opportunity->airport_des_c . " – " . $opportunity->airport_dep_c;
        $StartAndEnd = str_replace("-", ".", $opportunity->date_start_c) . " – по " . str_replace("-", ".", $opportunity->date_end_c);
        $Hotel = $opportunity->hotel_c;
        $HotelRoom = $opportunity->hotel_room_c;
        $Food = $GLOBALS['app_list_strings']['food_list'][$opportunity->food_c];
        $TBS = new clsTinyButStrong;
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
        $TBS->LoadTemplate('custom/modules/Opportunities/template.docx', OPENTBS_ALREADY_UTF8);
        $TBS->VarRef['ContractNum'] = $ContractNum;
        $TBS->VarRef['ContractDate1'] = $ContractDate1;
        $TBS->VarRef['ContractDate2'] = $ContractDate2;
        $TBS->VarRef['ContractDate3'] = $ContractDate3;
        $TBS->VarRef['FirstParticipantName'] = $FirstParticipantName;
        $TBS->VarRef['AmountParticipants'] = $AmountParticipants;
        $TBS->VarRef['AmountOfServices'] = number_format($AmountOfServices, 0, '', ' ');
        $TBS->VarRef['AmountOfServicesText'] = $AmountOfServicesText;
        $TBS->VarRef['AmountAndRate'] = number_format($AmountAndRate, 0, '', ' ');
        $TBS->VarRef['AmountAndRateText'] = $AmountAndRateText;
        $TBS->VarRef['PrepaymentAndRateText'] = $PrepaymentAndRateText;
        $TBS->VarRef['AmountRemainsAndRateText'] = $AmountRemainsAndRateText;
        $TBS->VarRef['Prepayment'] = number_format($Prepayment, 0, '', ' ');
        $TBS->VarRef['PrepaymentAndRate'] = number_format($PrepaymentAndRate, 0, '', ' ');
        $TBS->VarRef['Amount'] = number_format($Amount, 0, '', ' ');
        $TBS->VarRef['AmountRemains'] = number_format($AmountRemains, 0, '', ' ');
        $TBS->VarRef['AmountRemainsAndRate'] = number_format($AmountRemainsAndRate, 0, '', ' ');

        $TBS->VarRef['Currency'] = $Currency;
        $TBS->VarRef['FullPaymentDate'] = $FullPaymentDate;
        $TBS->VarRef['FirstParticipantPassport'] = $FirstParticipantPassport;
        $TBS->VarRef['FirstParticipantPassportDate'] = $FirstParticipantPassportDate;
        $TBS->VarRef['FirstParticipantPassportWho'] = $FirstParticipantPassportWho;
        $TBS->VarRef['FirstParticipantNameShort'] = $FirstParticipantNameShort;
        $TBS->VarRef['FirstParticipantAdress'] = $FirstParticipantAdress;
        $TBS->VarRef['Country'] = $Country;
        $TBS->VarRef['Resort'] = $Resort;
        $TBS->VarRef['Itinerary'] = $Itinerary;
        $TBS->VarRef['StartAndEnd'] = $StartAndEnd;
        $TBS->VarRef['Hotel'] = $Hotel;
        $TBS->VarRef['HotelRoom'] = $HotelRoom;
        $TBS->VarRef['Food'] = $Food;

        if($Prepayment<$Amount){
            $show=1;

        }
        $TBS->VarRef['show'] = $show;
        $data = array();
        foreach ($participants as $participant) {
            $data[] = array(
                'ParticipantName' => $participant->snamerus . " " . $participant->fnamerus . " " . $participant->mnamerus,
                'ParticipantNameEng' => mb_strtoupper($participant->name),
                'ParticipantBirthday' => str_replace("-", ".", $participant->birthday),
                'ParticipantPassport' => $participant->passport_num,
                'ParticipantPassportWho' => $participant->passport_who,
                'ParticipantPassportDate' => str_replace("-", ".", $participant->passport_date),
                'ParticipantAdress' => $participant->adress_c,
            );
        }

        $TBS->MergeBlock('participants', $data);
        $TBS->Show(OPENTBS_DOWNLOAD, "Договор");
        exit;

    }
}