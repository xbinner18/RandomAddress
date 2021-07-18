<?php

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function randomName() {
    $names = array(
        'Mischke',
        'Serna',
        'Pingree',
        'Mcnaught',
        'Pepper',
        'Schildgen',
        'Mongold',
        'Wrona',
        'Geddes',
        'Lanz',
        'Fetzer',
        'Schroeder',
        'Block',
        'Mayoral',
        'Fleishman',
        'Roberie',
        'Latson',
        'Lupo',
        'Motsinger',
        'Drews',
        'Coby',
        'Redner',
        'Culton',
        'Howe',
        'Stoval',
        'Michaud',
        'Mote',
        'Menjivar',
        'Wiers',
        'Paris',
        'Grisby',
        'Noren',
        'Damron',
        'Kazmierczak',
        'Haslett',
        'Guillemette',
        'Buresh',
        'Center',
        'Kucera',
        'Catt',
        'Badon',
        'Grumbles',
        'Antes',
        'Byron',
        'Volkman',
        'Klemp',
        'Pekar',
        'Pecora',
        'Schewe',
        'Ramage',
    );
    return $names[rand ( 0 , count($names) -1)];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.fakeaddressgenerator.com/');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: www.fakeaddressgenerator.com',
'User-Agent: Mozilla/5.0 (Linux; Android 10; vivo 1806) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.64 Mobile Safari/537.36',
'Accept-Language: en-US,en;q=0.9',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$res = curl_exec($ch);
$name = trim(strip_tags(getStr($res,'<td><span>Full Name</span></td>','</b>')));
$first = trim(strip_tags(getStr($res,'<td><b>','&nbsp;')));
$last = randomName();
$street = trim(strip_tags(getStr($res,'<td>Street</td>','</b></td>')));
$city = trim(strip_tags(getStr($res,'<td>City</td>','</b></td>')));
$state = trim(strip_tags(getStr($res,'State/Province abbr','</b></td>')));
$statefull = trim(strip_tags(getStr($res,'State/Province full','</b></td>')));
$zip = trim(strip_tags(getStr($res,'<td>Zip Code/Postal code','</b></td>')));
$phone = trim(strip_tags(getStr($res,'Phone Number','</b></td>')));

if($res == null){
  echo '{"message":"failed to get address"}';
}
else{
  echo '{"first":"'.$first.'","last":"'.$last.'","street":"'.$street.'","city":"'.$city.'","state":"'.$state.'","full":"'.$statefull.'","zip":"'.$zip.'","phone":"'.$phone.'"}';
}

?>
