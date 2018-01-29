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

<?php namespace MariuszAnuszkiewicz\src\Fetch;
include_once "./autoload/autoloading.php";
require_once "./config/config_store.php";

if(isset($_POST['create_picture_btn'])) {
    $convert = new DataConvertImage;
    $convert->content(new line_of_table\LineTable, new header_of_table\HeaderTable);
}

if(isset($_POST['delete_picture_btn'])) {
    unlink(Config::get('full_table'));
}

?>

</body>
</html>

