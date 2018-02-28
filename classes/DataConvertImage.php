<?php namespace MariuszAnuszkiewicz\classes\DataConvertImage;

use MariuszAnuszkiewicz\classes\Header\Header;
use MariuszAnuszkiewicz\classes\Lines\Lines;
use MariuszAnuszkiewicz\classes\DataStore\DataStore;

class DataConvertImage {

   private $content;
   public static $save_files = [

       0 => './web/upload/all_lines.png',
       1 => './web/upload/header.png',
       2 => './web/upload/table.png'

   ];

   public static $row_files = [

       0 => './web/upload/line_table1.png',
       1 => './web/upload/line_table2.png',
       2 => './web/upload/line_table3.png',
       3 => './web/upload/line_table4.png'

   ];

   public function content(Header $header, Lines $lines) {

       $this->content = $header->process(DataStore::getData("header"), 16, 13, 8, 13, 18, 12, 7, 31, 3, null);
       $this->content = $lines->process(DataStore::getData(1),  18, 26, 31, 26, 10, 16, 26, 36, 3, 1);
       $this->content = $lines->process(DataStore::getData(2),  18, 26, 31, 26, 10, 16, 26, 36, 3, 2);
       $this->content = $lines->process(DataStore::getData(3),  11, 26, 31, 26, 10, 16, 26, 37, 1, 3);
       $this->content = $lines->process(DataStore::getData(4),  11, 26, 31, 26, 10, 16, 26, 36, 3, 4);
       $this->mergeRowsTable(self::$save_files[0]);
       $this->mergeTable(self::$save_files[1], self::$save_files[0]);
       $this->showImage();

   }

   public function mergeRowsTable($fileToSave) {

       $dir = $fileToSave;
       for ($i = 0; $i < count(self::$row_files); $i++) {
           $files = self::$row_files[$i];
           list($width, $height) = getimagesize($files);
           $image = imagecreatetruecolor($width, $height * ($i+1));
           foreach (self::$row_files as $index => $file) {
               $im = imagecreatefrompng($file);
               imagecopy($image, $im, 0, $height * $index, 0, 0, $width, $height);
               imagepng($image, $dir);
               imagedestroy($im);
           }
       }

       for ($d = 0; $d < count(self::$row_files); $d++) {
           unlink(self::$row_files[$d]);
       }
   }

   public function mergeTable($filename_1, $filename_2) {

       if (file_exists($filename_1) && file_exists($filename_2)) {

           $dir = self::$save_files[2];
           list($width_x, $height_x) = getimagesize($filename_1);
           list($width_y, $height_y) = getimagesize($filename_2);
           $image = imagecreatetruecolor($width_x, ($height_x + $height_y));
           $image_x = imagecreatefrompng($filename_1);
           $image_y = imagecreatefrompng($filename_2);
           imagecopy($image, $image_x, 0, 0, 0, 0, $width_y, ($height_x + $height_y));
           imagecopy($image, $image_y, 0, $height_x, 0, 0, $width_y, ($height_y + $height_x));
           imagepng($image, $dir);
           imagedestroy($image);
           imagedestroy($image_x);
           imagedestroy($image_y);

           for ($d = 0; $d < count(self::$save_files) - 1; $d++) {
               unlink(self::$save_files[$d]);
           }
       }
   }

   public function showImage() {

       $directory = "./web/upload/";
       $images = glob($directory . "*");
       foreach($images as $image) {
           echo '<a href="' . $image . '" target="_blank"><img src="' . $image . '" height="160" width="1021" /></a>';
       }
   }
}


