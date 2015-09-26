<?php

if (isset ($_POST['post'])) {
  $post = unserialize(htmlspecialchars_decode($_POST['post']));
  $files = unserialize($_POST['files']);
  // var_dump($_POST['files_contents']);
  $files_contents = unserialize(base64_decode($_POST['files_contents']));
  // var_dump($files_contents); 
  // var_dump($files);
  
  $to = $_POST['toOne'];
  $from = $post['contactZZ'];
  $subject = $post['subject'];
  $message = $post['messageFF'];
  $freq = +$post['freq'];
  $boundary = md5(date('r', time()));
  $filesize = '';
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "From: " . $from . "\r\n";
  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
  $message="
Content-Type: multipart/mixed; boundary=\"$boundary\"

--$boundary
Content-Type: text/html; charset=\"utf-8\"
Content-Transfer-Encoding: 7bit

$message";
  for($i=0;$i<count($files['name']);$i++) {
      // if(is_uploaded_file($files['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode($files_contents[$i]));
         var_dump($attachment);
         // echo "Waht?\n";
         // var_dump($attachment);
         $filename = $files['name'][$i];
         $filetype = $files['type'][$i];
         $filesize += $files['size'][$i];
         $message.="

--$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     // } else {
      // echo "None file\n";
     // }
   }
  $message.="
--$boundary--";

  if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
    mail($to, $subject, $message, $headers);
    
    $output = "Ваше сообщение получено, спасибо!";
  } else {
    $output = "Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.";
  }
}
?>

<?php 
  if (isset($post['contactFF']))
    echo $output; 
  else
    echo "Зачем вы посетили эту страницу?";
?>