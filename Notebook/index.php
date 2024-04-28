<?php
  // Отображение ошибок на странице
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  include "config.php";
  include "db.php";
  include 'xtea.php';

  header('Content-Type: text/html; charset=utf-8');
  session_start();

  // Если не существует переменная ключа
  if (!isset($_SESSION['key'])) {
    $keyw = '<form action="" method="post"><input type="text" name="key" placeholder="Введите ваш ключ"><input type="submit" value="Сохранить"></form>';
  }
  // Иначе, если существует
  else {
    $keyw = '<button><a class="nodec_link" href="index.php?action=delkey">Удалить ключ</a></button>';
  }
  // Если отправлена форма сохранения ключа
  if (isset($_POST["key"])) {
    $_SESSION['key'] = $_POST["key"];
    header("Location: index.php");
    exit();
  }
  if ((isset($_GET['action'])) && ($_GET['action'] == 'delkey')) {
    unset($_SESSION['key']);
    header("Location: index.php");
    exit();
  }
  // если отправлена форма добавления записи
  if (isset($_POST["text"])) {
    $text = nl2br($_POST["text"]);

    $xtea = new XTEA($_SESSION['key']);
    $text = $xtea->Encrypt($text);

    $date_d = date("d");
    $date_m = date("m");
    $date_t = date("Y");
    $date_cat = date("n-Y");

    $db = new SafeMySQL($set_bd);
    $sql  = "INSERT INTO `notes` (`text`, `date_d`, `date_m`, `date_t`, `date_cat`) VALUES (?s, ?s, ?s, ?s, ?s)";
    $db->query($sql, $text, $date_d, $date_m, $date_t, $date_cat);
  }

  // Функия перевода номера месяца в его название
  function num2name($num) {
    switch ($num) {
      case '01':
        $name = "январь";
        break;
      case '02':
        $name = "февраль";
        break;
      case '03':
        $name = "март";
        break;
      case '04':
        $name = "апрель";
        break;
      case '05':
        $name = "май";
        break;
      case '06':
        $name = "июнь";
        break;
      case '07':
        $name = "июль";
        break;
      case '08':
        $name = "август";
        break;
      case '09':
        $name = "сентябрь";
        break;
      case '10':
        $name = "октябрь";
        break;
      case '11':
        $name = "ноябрь";
        break;
      case '12':
        $name = "декабрь";
        break;
      
      default:
        $name = "";
        break;
    }
    return $name;
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <title><?php echo $set_title; ?></title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="main">
      <table>
        <tr>
            <select onchange="location.href=this.options[this.selectedIndex].value;">
              <option value="index.php">Выбор месяца и года</option>
              <option value="index.php">Последине <?php echo $set_col; ?> записей</option>
              <?php
                $db = new SafeMySQL($set_bd);
                $option = $db->getAll("SELECT DISTINCT `date_cat` FROM `notes`");
                foreach ($option as $value) {
                  $desc_opt = explode("-", $value['date_cat']);
                  echo '<option value="index.php?date='.$value['date_cat'].'">'.num2name($desc_opt[0]).' '.$desc_opt[1].'</option>';
                }
              ?>
            </select>
        </tr>
        <tr>
          <?php echo $keyw; ?>
        </tr>
      </table>
      <h1><?php echo $set_title; ?></h1>
      <div class="addform">
        <form method="post" action="">
          <textarea rows="10" name="text" placeholder="Текст новой записи"></textarea>
          <input type="submit" value="Добавить">
        </form>
      </div>
      <div class="notes">
        <table class="table">
          <tbody>
            <?php 
              // Если отправлен запрос на конкретный месяц
              if (isset($_GET["date"])) {
                $cur_date = $_GET["date"];
                $db = new SafeMySQL($set_bd);
                $data = $db->getAll("SELECT * FROM `notes` WHERE `date_cat` = ?s ORDER BY `id` DESC", $cur_date);
                foreach ($data as $key) {
                  // Декодируем текст
                  $xtea = new XTEA($_SESSION['key']);
                  $text_decode = $xtea->Decrypt($key["text"]);
                  // Выводим записи
                  echo '<tr>
                    <td class="date">
                      <div class="date_m">'.num2name($key["date_m"]).'</div>
                      <div class="date_d">'.$key["date_d"].'</div>
                      <div class="date_t">'.$key["date_t"].'</div>
                    </td>
                    <td class="note_text" valign="top">'.$text_decode.'</td>
                  </tr>';
                }
              }
              // Если нет запроса на определённый месяц, выводим последние $set_col записей
              else {
                $db = new SafeMySQL($set_bd);
                $data = $db->getAll("SELECT * FROM `notes` ORDER BY `id` DESC LIMIT ?i", $set_col);
                foreach ($data as $key) {
                  // Декодируем текст
                  $xtea = new XTEA($_SESSION['key']);
                  $text_decode = $xtea->Decrypt($key["text"]);
                  // Выводим записи
                  echo '<tr>
                    <td class="date">
                      <div class="date_m">'.num2name($key["date_m"]).'</div>
                      <div class="date_d">'.$key["date_d"].'</div>
                      <div class="date_t">'.$key["date_t"].'</div>
                    </td>
                    <td class="note_text" valign="top">'.$text_decode.'</td>
                  </tr>';
                }
              } 
            ?>
          </tbody>
        </table>
      </div>

    </div>   
</body>
</html>