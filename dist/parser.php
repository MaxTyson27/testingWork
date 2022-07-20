<?php
 
$usd = $eur = 0;
$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));
 
if (!empty($xml)) {
	foreach ($xml->Valute as $item) {
		if ($item['ID'] == 'R01235') {
			$usd = $item->Value;
		} elseif ($item['ID'] == 'R01239') {
			$eur = $item->Value;
		}
	}
 
	if (!empty($usd) && !empty($eur)) {
		$usd = str_replace(',', '.', $usd);
		$eur = str_replace(',', '.', $eur);
	}
}
 
echo $usd .'<br>';
echo $eur;
 
?>