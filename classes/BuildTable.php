<?php namespace MariuszAnuszkiewicz\classes\BuildTable;

abstract class BuildTable {

   public static $files = [

      'line_table' => './web/upload/line_table',
      'header' => './web/upload/header.png',
      'on' => './web/img/on.png',
      'font' => './web/fonts/arial.ttf'

   ];

   public function getFile($file) {
       return self::$files[$file];
   }

   abstract public function process(array $data, int $interval);
}


