<?php

    require_once "./autoload/autoloading.php";
    require_once "./config/config_store.php";

    class DataConvertImage {

        private $header, $line_of_table;

        public function content(line_of_table\LineTable $line_of_table, header_of_table\HeaderTable $header) {

            $this->header = $header->process(array("Marka", "Model", "Rodzaj Paliwa", "Pojemność Silnika", "Lata Produkcji", "Moc Silnika", "Nadwozie", "Oznaczene silnika", "Opis"), null, 16, 13, 8, 13, 18, 12, 7, 31, 3);

            $this->line_of_table = $line_of_table->process(array("MAZDA", "6", "ON", "2.0", "09.2007->12.2008", "105KW/143KM", "GH", "RFT", "MZR-CD 16V"), 1, 18, 26, 31, 26, 10, 16, 26, 36, 3);
            $this->line_of_table = $line_of_table->process(array("MAZDA", "6", "ON", "2.2", "01.2009->12.2012", "137KW/186KM", "GH", "R2D", "MZR-CD 16V"), 2, 18, 26, 31, 26, 10, 16, 26, 36, 3);

            $this->mergeLineTable(Config::get('line_table1'), Config::get('line_table2'), 1);

            $this->line_of_table = $line_of_table->process(array("MAZDA", "6 KOMBI", "ON", "2.0", "09.2007->12.2008", "105KW/143KM", "GH", "RFT", "MZR-CD 16V"), 3, 18, 12, 32, 25, 10, 17, 26, 36, 3);
            $this->line_of_table = $line_of_table->process(array("MAZDA", "6 KOMBI", "ON", "2.2", "01.2009->12.2012", "137KW/186KM", "GH", "R2D", "MZR-CD 16V"), 4, 18, 12, 32, 25, 10, 17, 26, 35, 3);

            $this->mergeLineTable(Config::get('line_table3'), Config::get('line_table4'), 2);

            $this->mergeAllLines(Config::get('half_table1'), Config::get('half_table2'), Config::get('all_lines'));

            $this->mergeTable(Config::get('header'), Config::get('all_lines'));
            $this->deleteTmpFiles();
            $this->showImage();


        } // end content

        public function mergeLineTable($filename_1, $filename_2, $file_number) {

            if (func_num_args() > 1) {

                $dir = 'web/upload/half_table' . $file_number . '.png';

                list($width_x, $height_x) = getimagesize($filename_1);
                list($width_y, $height_y) = getimagesize($filename_2);

                $image = imagecreatetruecolor($width_x, $height_x + $height_y);

                $image_x = imagecreatefrompng($filename_1);
                $image_y = imagecreatefrompng($filename_2);

                imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, ($height_x + $height_y));
                imagecopy($image, $image_y, 0, $height_y, 0, 0, $width_y, ($height_y + $height_x));
                imagepng($image, $dir);

                imagedestroy($image);
                imagedestroy($image_x);
                imagedestroy($image_y);

            } // end if

        } // end buildTable

        public function mergeAllLines($filename_1, $filename_2, $filename_result) {

            if (func_num_args() > 1) {

                list($width_x, $height_x) = getimagesize($filename_1);
                list($width_y, $height_y) = getimagesize($filename_2);

                $image = imagecreatetruecolor($width_x, $height_x + $height_y);

                $image_x = imagecreatefrompng($filename_1);
                $image_y = imagecreatefrompng($filename_2);

                imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, ($height_x + $height_y));
                imagecopy($image, $image_y, 0, $height_y, 0, 0, $width_y, ($height_y + $height_x));

                imagepng($image, $filename_result);

                imagedestroy($image);
                imagedestroy($image_x);
                imagedestroy($image_y);

            } // end if

        } // end buildTable

        public function mergeTable($filename_1, $filename_2) {

            if (func_num_args() > 1) {

                $dir = 'web/upload/full_table.png';

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

            } // end if

        } // end buildTable

        public function showImage(){

            $dirname = "./web/upload/";
            $images = glob($dirname . "*");
            foreach($images as $image) {

                echo '<a href="' . $image . '" target="_blank"><img src="' . $image . '" height="160" width="1021" /></a>';

            }

        }  // end showImage

        public function deleteTmpFiles() {

            $files = [

                0 => 'web/upload/line_table1.png',
                1 => 'web/upload/line_table2.png',
                2 => 'web/upload/line_table3.png',
                3 => 'web/upload/line_table4.png',
                4 => 'web/upload/half_table1.png',
                5 => 'web/upload/half_table2.png',
                6 => 'web/upload/all_lines.png',
                7 => 'web/upload/header.png'

            ];

            for ($i = 0; $i < count($files); $i++) {

                unlink($files[$i]);

            }

        } // end deleteTmpFiles


    } // end class


?>