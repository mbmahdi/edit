<?php
ob_start();
define('API_KEY','243156119:AAGLZ_q0fo1dUfdxdi7xT4ipFfWFQYHrG4w');
$admin = "220647586";
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$file_o = __DIR__.'/users/'.$mid.'.json';
file_put_contents($file_o,json_encode($update->message->text));
chmod($file_o,0777);
if (isset($update->edited_message)){
  //$chat_id1 = $editm->chat->id;
  $eid = $editm->message_id;
  $edname = $editm->from->first_name;
  $jsu = json_decode(file_get_contents(__DIR__.'/users/'.$eid.'.json'));
  $text = "<b>".$edname."</b>\nکونی دیدم که چی گفتی بازم ادیت کنی میفهمم کونی
  گفتی:
".$jsu;
  $id = $update->edited_message->chat->id;
  bot('sendmessage',[
    'chat_id'=>$id,
    'reply_to_message_id'=>$eid,
    'text'=>$text,
    'parse_mode'=>'html'
  ]);
  $file_o = __DIR__.'/users/'.$eid.'.json';
  file_put_contents($file_o,json_encode($update->edited_message->text));
  //$up = file_get_contents(__DIR__.'/users/'.$eid.'.json');
  //str_replace("edited_message","message",$up);
}elseif(preg_match('/^\/([Ss]tart)/',$text1)){
  $text = "به ربات ادیت نکن کونی\nخوش آمدید\nبرای اد کردن من به گروه بر روی لینک زیر بزنید\nhttps://telegram.me/editnakonkonibot?startgroup=new";
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'mahdi_editor','url'=>'https://telegram.me/mahdi_editor']
        ],
        [
          ['text'=>'CreateBOT','url'=>'https://telegram.me/pvnobot']
        ] 
      ]
    ])
  ]);
}elseif( $fadmin == $admin |  $fadmin == $admin2 and $update->message->text == '/stats'){
    $txtt = file_get_contents('member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
  bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"کاربران : $mmemcount 👤 "
    ]);
}elseif( $fadmin == $admin | {
$memcout = count($membersidd)-1;
	 	apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => "📦 پیام شما به  ".$memcout." مخاطب ازسال شد.
.","parse_mode" =>"HTML",'reply_markup' => array(
        'keyboard' => array(array('🗣 Send To All'),array('⚓️ Help','👥 Members','❌ Blocked Users'),array("Settings ⚙")),
        'one_time_keyboard' => true,
        'selective' => true,
        'resize_keyboard' => true)));
         $addd = "false";
    	file_put_contents('booleans.txt',$addd); 
     ]);
}elseif(isset($update->message-> new_chat_member )){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>""
    ]);
}
  
  
  
  
  
  
  
$txxt = file_get_contents('member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('member.txt');
      $aaddd .= $chat_id."\n";
      file_put_contents('member.txt',$aaddd);
    }
