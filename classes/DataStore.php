<?php namespace MariuszAnuszkiewicz\classes\DataStore;

class DataStore {

   private static $data = [

      "header" => ["Marka", "Model", "Rodzaj Paliwa", "Pojemność Silnika", "Lata Produkcji", "Moc Silnika", "Nadwozie", "Oznaczene silnika", "Opis"],
      1 => ["MAZDA", "6", "ON", "2.0", "09.2007->12.2008", "105KW/143KM", "GH", "RFT", "MZR-CD 16V"],
      2 => ["MAZDA", "6", "ON", "2.2", "01.2009->12.2012", "137KW/186KM", "GH", "R2D", "MZR-CD 16V"],
      3 => ["MAZDA", "6 KOMBI", "ON", "2.0", "09.2007->12.2008", "105KW/143KM", "GH", "RFT", "MZR-CD 16V"],
      4 => ["MAZDA", "6 KOMBI", "ON", "2.2", "01.2009->12.2012", "137KW/186KM", "GH", "R2D", "MZR-CD 16V"]

   ];

   public static function getData($key) {
       return self::$data[$key];
   }
}

