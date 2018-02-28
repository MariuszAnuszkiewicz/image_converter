<?php namespace MariuszAnuszkiewicz\classes\Lines;

use MariuszAnuszkiewicz\classes\BuildTable\BuildTable;

class Lines extends BuildTable {

    private $getArgs, $numArgs;

    public function process(array $data, int $interval) {

        $this->numArgs = func_num_args();
        $this->getArgs = func_get_args();
        $last_arg = [];
        $last_arg[] = end($this->getArgs);
        $integer = array_map('intval', $this->getArgs);
        $end = array_map('intval', ($last_arg));
        $file = implode(" ", $end);
        $string = null;
        $indentation = str_repeat(" ", 4);

        foreach ($this->getArgs as $arg) {
            $string .= $indentation . $arg[0] . str_repeat(" ", $integer[1]);
            $i = 0;
            while ($i < $this->numArgs - 3) {
                $i++;
                $string .= $arg[$i] . str_repeat(" ", $integer[$i]);
            }
            break;
        }

        $font = realpath(dirname(dirname(__FILE__)) . $this->getFile('font'));
        $directory_file = $this->getFile('line_table') . $file . '.png';

        if (!file_exists($directory_file)) {

            $file = fopen($directory_file, "a+");
            $im = @imagecreate(1021, 34);
            imagecolorallocate($im, 255, 255, 255);
            $text_color = imagecolorallocate($im, 0, 0, 0);
            $line_color = imagecolorallocate($im, 29, 122, 251);
            imageline($im, 0, 33, 1021, 33, $line_color);
            imagettftext($im, 9, 0, 10, 21, $text_color, $font, $string);
            imagepng($im, $file);
            imagedestroy($im);
            $this->pasteImage($directory_file);
        }
    }

    public function pasteImage($file_number){

        $paste_file = $this->getFile('on');
        $file = $file_number;
        list($width_x, $height_x) = getimagesize($file_number);
        list($width_y, $height_y) = getimagesize($paste_file);
        $image = imagecreatetruecolor($width_x, $height_x);
        $image_x = imagecreatefrompng($file_number);
        $image_y = imagecreatefrompng($paste_file);
        imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, 34);
        imagecopy($image, $image_y, 173, 5, 0, 0, $width_y, $height_y);
        imagecopymerge($image, $image_x, 0, 0, 0, 0, $width_x, 34, 0);
        imagecopymerge($image, $image_y, 0, 0, 0, 0, $width_y, 34, 0);
        imagepng($image, $file);
        imagedestroy($image_x);
        imagedestroy($image_y);
    }
}


