<?php

//@author Pavel Rice

// PHP Simple HTML DOM Parser
require('simple_html_dom.php');
$bom = "\xEF\xBB\xBF";
$header = "Название в Brandpolaris;Цена на Brandpolaris;Модельный год\n";
$tofile = $header;

// rzr ------------------------------------------------------------------------------------------------------------------------------


// rzr 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/rzr/new/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// rzr 2020
$result = file_get_contents('https://www.brandtpolaris.ru/technique/rzr/2020/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2020');
$html->clear();

// ranger ------------------------------------------------------------------------------------------------------------------------------

// ranger 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/ranger/new/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// ranger 2020
$result = file_get_contents('https://www.brandtpolaris.ru/technique/ranger/2020/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html,  '2020');
$html->clear(); 

// ranger 2019
$result = file_get_contents('https://www.brandtpolaris.ru/technique/ranger/2019/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html,  '2019');
$html->clear();

// general ------------------------------------------------------------------------------------------------------------------------------

// general 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/general/new/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// квадроциклы ------------------------------------------------------------------------------------------------------------------------------

// квадроциклы 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/atv/new/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// квадроциклы 2020
$result = file_get_contents('https://www.brandtpolaris.ru/technique/atv/2020/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2020');
$html->clear();

// квадроциклы 2013
$result = file_get_contents('https://www.brandtpolaris.ru/technique/atv/2013/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2013');
$html->clear();

// ace -----------------------------------------------------------------------------------------------------------------------------------

// ace 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/ace/new1/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// ace 2017
$result = file_get_contents('https://www.brandtpolaris.ru/technique/ace/2017/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2017');
$html->clear();

// снегоходы ------------------------------------------------------------------------------------------------------------------------------

// снегоходы 2022
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/new/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2022');
$html->clear(); 

// снегоходы 2021
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2021/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2021');
$html->clear(); 

// снегоходы 2020
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2020/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2020');
$html->clear();

// снегоходы 2019
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2019/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2019');
$html->clear();

// снегоходы 2018
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2018/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2018');
$html->clear();

// снегоходы 2017
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2017/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2017');
$html->clear();

// снегоходы 2015
$result = file_get_contents('https://www.brandtpolaris.ru/technique/snowmobile/2015/');
$html = str_get_html($result);
$tofile .= getCsvStringFromHtmlNew($html, '2015');
$html->clear();

file_put_contents('polaris.csv', $bom . $tofile);
unset($html);
return;



function getCsvStringFromHtml($html, $namesArray) {
	$tofile = '';
	foreach($html->find('ul.models li') as $element) {
		$name = '';
		$price = '';
		foreach($element->find('a.header_name_item') as $a) {
			$name = trim($a->title);
		}
		foreach($element->find('span.cost strong') as $span) {
			$price = $span->plaintext;
			$price = mb_substr($price, 0, mb_strlen($price) - 2);
		}
		$bitrixName = $namesArray[$name];
		$tofile .= "$bitrixName;$name;$price;\n";
	}
	return $tofile;
}



function getCsvStringFromHtmlNew($html, $year) {
	$tofile = '';
	foreach($html->find('ul.models li') as $element) {
		$name = '';
		$price = '';
		foreach($element->find('a.header_name_item') as $a) {
			$name = $year . " " . trim($a->title);
		}
		foreach($element->find('span.cost strong') as $span) {
			$price = $span->plaintext;
			$price = mb_substr($price, 0, mb_strlen($price) - 2);
		}
		$tofile .= "$name;$price;$year\n";
	}
	return $tofile;
}


