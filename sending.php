<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Sending</title>
  <script src="sending.js"></script>
  <style>
    .hidden {
      display: none;
    }
    span {
      border: 1px solid black;
      padding: 4px;
    }
    table {
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <?php
    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';
    $files_contents = [];
    for ($i = 0; $i < count($_FILES['fileFF']['tmp_name']); $i++) {
      $filename = $_FILES['fileFF']['tmp_name'][$i];
      // echo "$filename\n";
      $files_contents[] = file_get_contents($filename);
    }
    // var_dump($files_contents);
    // var_dump($files_contents);
    echo('<p class="hidden" id="post">'.serialize($_POST).'</p>');
    echo('<p class="hidden" id="files">'.serialize($_FILES['fileFF']).'</p>');
    if ($_FILES['toMany']['tmp_name'] != "") {
      $filenames = file_get_contents($_FILES['toMany']['tmp_name']);
    } else {
      $filenames = $_POST['contactFF'];
    }
    echo('<p class="hidden" id="files_contents">'.base64_encode(serialize($files_contents)).'</p>');
    echo('<p class="hidden" id="toMany">'.$filenames.'</p>');
    echo('<p class="hidden" id="freq">'.$_POST['freq'].'</p>');    

  ?>
  <table>
    <tr>
      <td width="100px"><h3>Отчет</h3></td>
      <td>
        <p id="st1"></p>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <p id="st2"></p>
      </td>
    </tr>
  </table>
</body>
</html>