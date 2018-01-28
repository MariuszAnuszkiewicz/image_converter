<?php
namespace build_table {

    include_once "./autoload/autoloading.php";

    class BuildTable {

        protected function process(array $data, $file_number = null, $set_interval0, $set_interval1, $set_interval2, $set_interval3, $set_interval4, $set_interval5, $set_interval6, $set_interval7, $set_interval8) {

            if (is_array($data)) {

                $return_args = function ($value) {
                    return $value;
                };

                $single_val = array_map($return_args, $data);
                $quantity_args = count($single_val);
                $indentation = str_repeat(" ", 4);
                $string = null;

                for ($i = 0; $i < $quantity_args; $i++) {

                    if ($i == 0) {
                        $string .= $indentation . $single_val[$i] . str_repeat(" ", $set_interval0);
                    }
                    if ($i == 1) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval1);
                    }
                    if ($i == 2) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval2);
                    }
                    if ($i == 3) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval3);
                    }
                    if ($i == 4) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval4);
                    }
                    if ($i == 5) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval5);
                    }
                    if ($i == 6) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval6);
                    }
                    if ($i == 7) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval7);
                    }
                    if ($i == 8) {
                        $string .= $single_val[$i] . str_repeat(" ", $set_interval8);
                    }

                }

                $font = './web/fonts/arial.ttf';

                if(!empty($file_number)) {

                    $dir = 'web/upload/line_table' . $file_number . '.png';

                    $im = @imagecreate(1021, 34);

                    imagecolorallocate($im, 255, 255, 255); // white background
                    $text_color = imagecolorallocate($im, 0, 0, 0); // black text
                    $line_color = ImageColorAllocate($im, 29, 122, 251);
                    ImageLine($im, 0, 33, 1021, 33, $line_color);

                    imagettftext($im, 9, 0, 10, 21, $text_color, $font, $string);

                    imagepng($im, $dir);
                    imagedestroy($im);

                    $this->pasteImage($file_number);

                }else{

                    $dir = 'web/upload/header.png';

                    $im = @imagecreate(1021, 24);

                    imagecolorallocate($im, 29, 122, 251); // blue background
                    $text_color = imagecolorallocate($im, 255, 255, 255); // white text

                    imagettftext($im, 9, 0, 10, 17, $text_color, $font, $string);

                    imagepng($im, $dir);
                    imagedestroy($im);

                } // end else

            } // end if is_array

        } // end process method

        public function pasteImage($file_number){

            $filename_1 = './web/upload/line_table' . $file_number . '.png';
            $filename_2 = "./web/img/on.png";
            $dir = './web/upload/line_table' . $file_number . '.png';

            list($width_x, $height_x) = getimagesize($filename_1);
            list($width_y, $height_y) = getimagesize($filename_2);

            $image = imagecreatetruecolor($width_x, $height_x);

            $image_x = imagecreatefrompng($filename_1);
            $image_y = imagecreatefrompng($filename_2);

            imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, 34);
            imagecopy($image, $image_y, 197, 5, 0, 0, $width_y, $height_y);
            imagecopymerge($image, $image_x, 0, 0, 0, 0, $width_x, 34, 0);

            imagepng($image, $dir);

            imagedestroy($image_x);
            imagedestroy($image_y);

        } // end pasteImage

    } // end class BuildTable

} // end namespace

namespace line_of_table {

    use build_table;

    include_once "./autoload/autoloading.php";

    class BuildTable extends build_table\BuildTable {

        protected function process(array $data, $file_number = null, $set_interval0, $set_interval1, $set_interval2, $set_interval3, $set_interval4, $set_interval5, $set_interval6, $set_interval7, $set_interval8) {

            parent::process($data, $file_number, $set_interval0, $set_interval1, $set_interval2, $set_interval3, $set_interval4, $set_interval5, $set_interval6, $set_interval7, $set_interval8);

        } // end process method

    } // end class BuildTable

} // end namespace

namespace header_of_table {

    use build_table;

    include_once "./autoload/autoloading.php";

    class BuildTable extends build_table\BuildTable {

        protected function process(array $data, $file_number = null, $set_interval0, $set_interval1, $set_interval2, $set_interval3, $set_interval4, $set_interval5, $set_interval6, $set_interval7, $set_interval8) {

            parent::process($data, $file_number, $set_interval0, $set_interval1, $set_interval2, $set_interval3, $set_interval4, $set_interval5, $set_interval6, $set_interval7, $set_interval8);

        } // end process method

    } // end class BuildTable

} // end namespace

?>