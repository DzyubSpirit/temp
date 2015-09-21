
<!DOCTYPE HTML>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Контактная форма</title>
<style>
#feedback-form { /* вся форма */
  max-width: 550px;
  padding: 2%;
  border-radius: 3px;
  background: #f1f1f1;
}
#feedback-form label { /* наименование полей */
  float: left;
  display: block;
  clear: right;
  max-width: 130px;
}
#feedback-form .w100 { /* поля */
  float: right;
  max-width: 400px;
  width: 97%;
  margin-bottom: 1em;
  padding: 1.5%;
}
#feedback-form .border { /* граница полей */
  border-radius: 1px;
  border-width: 1px;
  border-style: solid;
  border-color: #C0C0C0 #D9D9D9 #D9D9D9;
  box-shadow: 0 1px 1px rgba(255,255,255,.5), 0 1px 1px rgba(0,0,0,.1) inset;
}
#feedback-form .border:focus {
  outline: none;
  border-color: #abd9f1 #bfe3f7 #bfe3f7;
}
#feedback-form .border:hover {
  border-color: #7eb4ea #97cdea #97cdea;
}
#feedback-form .border:focus::-moz-placeholder { /* убрать при фокусе первоначальный текст поля */
  color: transparent;
}
#feedback-form .border:focus::-webkit-input-placeholder {
  color: transparent;
}
#feedback-form .border:not(:focus):not(:hover):valid { /* правильно заполненные поля */
  opacity: .8;
}
#submitFF { /* кнопка "Отправить" */
  padding: 2%;
  border: none;
  border-radius: 3px;
  box-shadow: 0 0 0 1px rgba(0,0,0,.2) inset;
  background: #669acc;
  color: #fff;
}
#feedback-form br {
  height: 0;
  clear: both;
}
#submitFF:hover {
  background: #5c90c2;
}
#submitFF:focus {
  box-shadow: 0 1px 1px #fff, inset 0 1px 2px rgba(0,0,0,.8), inset 0 -1px 0 rgba(0,0,0,.05);
}/*
.inlineDiv {
  display: inline-block;
}*/

.inline-divs div {
  display: inline-block;
}

#freq-lbl {
  font-size: 14px;
}
#toMany-lbl {
  font-size: 10px;
}
#importButton {
  font-size: 8px;
  height: 20px;
}/*
#toMany {
  float: right;
}*/

</style>

<script>
window.onload = function() {
  var toMany = document.getElementById('toMany');
  var importButton = document.getElementById('importButton');
  var toManyLbl = document.getElementById('toMany-lbl');
  var contactFF = document.getElementById('contactFF');

  if (toMany.value != '') {
    toManyLbl.innerHTML = toMany.value;
  }

  toMany.onchange = function() {
    contactFF.type = 'text';
    contactFF.placeholder = 'Теперь это поле не важно';
    contactFF.required = false;
    contactFF.value = '';
    toManyLbl.innerHTML = toMany.value;
  }

  importButton.onclick = function() {
    toMany.click();
  }
}
</script>

<form enctype="multipart/form-data" action="sending.php" method="post" id="feedback-form">
<label for="subject">Тема:</label>
<input type="text" name="subject" id="subject" required placeholder="например, Важное сообщение" x-autocompletetype="name" class="w100 border">
<label for="contactZZ">От кого:</label>
<input type="email" name="contactZZ" id="contactZZ" required placeholder="например, ivan@yandex.ru" x-autocompletetype="email" class="w100 border">

 <div class="inline-divs">
  <div style="width:68%">
    <label for="contactFF" >Кому:</label>
    <input style="width:61%" type="email" name="contactFF" id="contactFF" required placeholder="например, ivan@yandex.ru" x-autocompletetype="email" class="w100 border">

  </div>
  <div style="float:right;width:31%">
    <input style="display:none" type="file" accept="text/plain" name="toMany" id="toMany" class="w100"> 
    <input type="button" id="importButton" value="Импортировать адресса из файла (txt)">
    <div style="width:100%"><label style="display:block;width:100%;height:100%;text-align:center" for="toMany" id="toMany-lbl">Файл не выбран</label></div>
  </div>

</div> 

<label for="fileFF">Прикрепить файл:</label>
<input type="file" name="fileFF[]" multiple id="fileFF" class="w100">
<label for="messageFF">Сообщение:</label>
<textarea name="messageFF" id="messageFF" required rows="5" placeholder="Введите текст сообщения" class="w100 border"></textarea>
<label id="freq-lbl" for="freq">Количество отправок за 60 секунд:</label>
<input type="text" name="freq" id="freq" required placeholder="например, 15"class="w100 border">
<br>
<input value="Отправить" type="submit" formtarget="_blank" id="submitFF">
</form>