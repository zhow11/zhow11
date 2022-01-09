<?php

$token = '1008264405:AAE_6ziGzgLCcKoIQvcYr9An9CttmrIaFHE';


$update = file_get_contents("php://input");
$update = json_decode($update, true);


$text = $update["message"]["text"];
$chat_id = $update["message"]["chat"]["id"];








$user1 = file_get_contents("user1.json");
$user1 = json_decode($user1, true);
$user2 = file_get_contents("user2.json");
$user2 = json_decode($user2, true);
// pengumpulan user 1&2 ke $users
$users = array();
foreach ($user1 as $user){
$users[] = $user;
$users1[] = $user;
}
foreach ($user2 as $userr){
$users[] = $userr;
$users2[] = $userr;
}
$id = $chat_id;

// mendeteksi keberadaan user
if (in_array($id, $users)){
$stat = "ada";
}else{
$stat = "gak ada";
}




if ($stat == "ada"){

if(preg_match("/\/stop/", $text)){

$users1 = array();
$users2 = array();
$user1 = file_get_contents("user1.json");
$user1 = json_decode($user1, true);
$user2 = file_get_contents("user2.json");
$user2 = json_decode($user2, true);
// pengumpulan user 1&2 ke $users
foreach ($user1 as $no=>$user){
$users1[] = $user;
if(preg_match("/$id/", $user)){
$ke = $no;
$file = "user2.json";
$file2 = "user1.json";
}
}
foreach ($user2 as $no=>$userr){
$users2[] = $userr;
if(preg_match("/$id/", $userr)){
$ke = $no;
$file = "user1.json";
$file2 = "user2.json";
}
}

$users1 = array();
$users2 = array();
// Menghapus User Dari user.json
// user1.json
foreach ($user1 as $no=>$userr){
if ($no != $ke){
$users1[] = $userr;
}
if ($no == $ke){
$chat_id = $userr;
}
}
foreach ($user2 as $no=>$userrr){
if ($no != $ke){
$users2[] = $userrr;
}
if ($no == $ke){
$chat_id2 = $userrr;
}
}

$mes = "
Upsss Lawan Bicaramu Menghentikan Obrolan
/search Untuk Mencari Partner Lain
";
$mes = rawurlencode($mes);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$mes");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id2&text=$mes");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);


$en1 = json_encode($users1, JSON_PRETTY_PRINT);
$en2 = json_encode($users2, JSON_PRETTY_PRINT);

file_put_contents("user1.json", $en1);
file_put_contents("user2.json", $en2);


exit();
}

$users1 = array();
$users2 = array();
$user1 = file_get_contents("user1.json");
$user1 = json_decode($user1, true);
$user2 = file_get_contents("user2.json");
$user2 = json_decode($user2, true);
// pengumpulan user 1&2 ke $users
foreach ($user1 as $no=>$user){
$users1[] = $user;
if(preg_match("/$id/", $user)){
$ke = $no;
$file = "user2.json";
}
}
foreach ($user2 as $no=>$userr){
$users2[] = $userr;
if(preg_match("/$id/", $userr)){
$ke = $no;
$file = "user1.json";
}
}

$lawan = file_get_contents($file);
$lawan = json_decode($lawan, true);
foreach ($lawan as $la){
$c[] = $la;
}

$chat_id = $c[$ke];




// akhir dari $stat == ada
}
if ($stat == "gak ada"){

if(preg_match("/\/search/", $text) || preg_match("/\/start/", $text)){
// Masih Kosong, Ini Untuk Nambah Ke Tunggu.json
// Abis Itu Dihitung >= 2 Baru Dimasukkin Ke user1.json & user2.json
$tunggu = file_get_contents("tunggu.json");
$tunggu = json_decode($tunggu, true);
foreach ($tunggu as $t){
$i[] = $t;
}
$i[] = $id;

// masukkan ke user.json jika sudah 2 user
if (count($i) >= 2){

$users1 = array();
$users2 = array();
$user1 = file_get_contents("user1.json");
$user1 = json_decode($user1, true);
$user2 = file_get_contents("user2.json");
$user2 = json_decode($user2, true);
// pengumpulan user 1&2 ke $users
$users = array();
foreach ($user1 as $user){
$users[] = $user;
$users1[] = $user;
}
foreach ($user2 as $userr){
$users[] = $userr;
$users2[] = $userr;
}
if ($i[0] == $i[1]){
exit();
}
$users1[] = $i[0];
$users2[] = $i[1];

$chat_id3 = $i[0];
$chat_id4 = $i[1];

$mes = "
Partner Ditemukan ðŸ¥³ðŸ¥³
/stop Untuk Menghentikan Obrolan
";
$mes = rawurlencode($mes);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id3&text=$mes");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id4&text=$mes");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);



$en1 = json_encode($users1, JSON_PRETTY_PRINT);
$en2 = json_encode($users2, JSON_PRETTY_PRINT);

file_put_contents("user1.json", $en1);
file_put_contents("user2.json", $en2);
unlink("tunggu.json");
}else{
$en = json_encode($i, JSON_PRETTY_PRINT);
file_put_contents("tunggu.json", $en);

}
}



exit();
}








$caption = $update["message"]["caption"];

		//type-type
// text
$text = $update["message"]["text"];
if ($text != null){
$type = "text";
}
// sticker
$sticker = $update["message"]["sticker"];
if ($sticker != null){
$type = "sticker";
$file_id = $sticker["file_id"];
}
// voice
$voice = $update["message"]["voice"];
if ($voice != null){
$type = "voice";
$file_id = $voice["file_id"];
}
// audio
$audio = $update["message"]["audio"];
if ($audio != null){
$type = "audio";
$file_id = $audio["file_id"];
}
// video
$video = $update["message"]["video"];
if ($video != null){
$type = "video";
$file_id = $video["file_id"];
}
// foto
$foto = $update["message"]["photo"];
foreach ($foto as $fotos){
$photo[] = $fotos["file_id"];
}
if ($photo != null){
$type = "photo";
$file_id = $photo[0];
}




// get status reply
$reply_to_message = $update["message"]["reply_to_message"];
if ($reply_to_message != null){
$stat = "reply";
$message_id = $update["message"]["reply_to_message"]["message_id"];
}elseif ($reply_to_message == null){
$stat = "noreply";
}



//.                          pembuatan function
//.          ada message id
// text
function textr($token, $text, $chat_id, $message_id){
$text = rawurlencode($text);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
function text($token, $text, $chat_id){
$text = rawurlencode($text);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
// sticker
function stickerr($token, $file_id, $chat_id, $message_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendSticker?chat_id=$chat_id&sticker=$file_id&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
function sticker($token, $file_id, $chat_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendSticker?chat_id=$chat_id&sticker=$file_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
// voice
function voicer($token, $file_id, $chat_id, $message_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVoice?chat_id=$chat_id&voice=$file_id&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
function voice($token, $file_id, $chat_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVoice?chat_id=$chat_id&voice=$file_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
// audio
function audior($token, $file_id, $chat_id, $message_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendAudio?chat_id=$chat_id&audio=$file_id&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
function audio($token, $file_id, $chat_id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendAudio?chat_id=$chat_id&audio=$file_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
// video
function videor($token, $file_id, $chat_id, $message_id, $caption){
if ($caption != null){
$caption = rawurlencode($caption);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVideo?chat_id=$chat_id&video=$file_id&caption=$caption&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}else{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVideo?chat_id=$chat_id&video=$file_id&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
}
function video($token, $file_id, $chat_id, $caption){
if ($caption != null){
$caption = rawurlencode($caption);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVideo?chat_id=$chat_id&video=$file_id&caption=$caption");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}else{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendVideo?chat_id=$chat_id&video=$file_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
}
// foto
function photor($token, $file_id, $chat_id, $message_id, $caption){
if ($caption != null){
$caption = rawurlencode($caption);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendPhoto?chat_id=$chat_id&photo=$file_id&caption=$caption&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}else{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendPhoto?chat_id=$chat_id&photo=$file_id&reply_to_message_id=$message_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
}
function photo($token, $file_id, $chat_id, $caption){
$ch = curl_init();
if ($caption != null){
$caption = rawurlencode($caption);
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendPhoto?chat_id=$chat_id&photo=$file_id&caption=$caption");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}else{
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendPhoto?chat_id=$chat_id&photo=$file_id");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
}
}















//                                    eksekusi
// tipe text
if ($type == "text"){
	if ($stat == "reply"){
		text($token, $text, $chat_id, $message_id);
	}elseif ($stat == "noreply"){
		text($token, $text, $chat_id);
	}
}
// tipe sticker
if ($type == "sticker"){
	if ($stat == "reply"){
		sticker($token, $file_id, $chat_id, $message_id);
	}elseif ($stat == "noreply"){
		sticker($token, $file_id, $chat_id);
	}
}
// tipe voice
if ($type == "voice"){
	if ($stat == "reply"){
		voice($token, $file_id, $chat_id, $message_id);
	}elseif ($stat == "noreply"){
		voice($token, $file_id, $chat_id);
	}
}
// tipe audio
if ($type == "audio"){
	if ($stat == "reply"){
		audio($token, $file_id, $chat_id, $message_id);
	}elseif ($stat == "noreply"){
		audio($token, $file_id, $chat_id);
	}
}
// tipe video
if ($type == "video"){
	if ($stat == "reply"){
		video($token, $file_id, $chat_id, $message_id, $caption);
	}elseif ($stat == "noreply"){
		video($token, $file_id, $chat_id, $caption);
	}
}
// tipe photo
if ($type == "photo"){
	if ($stat == "reply"){
		photo($token, $file_id, $chat_id, $message_id, $caption);
	}elseif ($stat == "noreply"){
		photo($token, $file_id, $chat_id, $caption);
	}
}












?>
