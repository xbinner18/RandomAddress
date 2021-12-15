<?php

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fakepersongenerator.com/fake-name-generator');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'User-Agent: Mozilla/5.0 (Linux; Android 10; vivo 1806) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.64 Mobile Safari/537.36',
'Accept-Language: en-US,en;q=0.9',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$res = curl_exec($ch);
$name = trim(strip_tags(getStr($res,"class='text-center name'><b class='click'>",'</b>')));
$first = multiexplode(array("&nbsp;"), $name)[0];
$last = multiexplode(array("&nbsp;"), $name)[2];
$street = trim(strip_tags(getStr($res,'<p>Street: <b>','</b>')));
$stct = trim(strip_tags(getStr($res,'<p>City, State, Zip: <b>','</b>')));
$city = multiexplode(array(","), $stct)[0];
$statefull = multiexplode(array(","), $stct)[1];
$state = trim(strip_tags(getStr($statefull,'(',')')));
$zip = multiexplode(array(","), $stct)[2];
$phone = trim(strip_tags(getStr($res,"title='test'>Mobile: <b>",'</b>')));

if($res == null){
  echo '{"message":"failed to get address"}';
}
else{
  echo '{"first":"'.$first.'","last":"'.$last.'","street":"'.$street.'","city":"'.$city.'","state":"'.$state.'","full":"'.$statefull.'","zip":"'.$zip.'","phone":"'.$phone.'"}';
}

?>
