<?php

use MariuszAnuszkiewicz\classes\Header\Header;
use MariuszAnuszkiewicz\classes\Lines\Lines;
use MariuszAnuszkiewicz\classes\DataConvertImage\DataConvertImage;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(__FILE__));
}
if (!defined('AUTOLOAD')) {
    define('AUTOLOAD', './autoload');
}

require_once AUTOLOAD . DS . "autoloading.php";

if(isset($_POST['create_picture_btn'])) {
   $convert = new DataConvertImage;
   $convert->content(new Header, new Lines);
}

if(isset($_POST['delete_picture_btn'])) {
   $convert = new DataConvertImage;
   unlink($convert::$save_files[2]);
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>

<div class="section_process">
    <form action="" method="post" id="create_picture">
        <input type="submit" name="create_picture_btn" id="create_picture" value="Wykonaj Obraz" />
        <input type="submit" name="delete_picture_btn" id="delete_picture" value="Usuń Obraz" />
    </form>
</div>
</body>
</html>

