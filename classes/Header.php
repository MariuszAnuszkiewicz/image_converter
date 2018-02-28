<?php namespace MariuszAnuszkiewicz\classes\Header;

use MariuszAnuszkiewicz\classes\BuildTable\BuildTable;

class Header extends BuildTable {

    private $getArgs, $numArgs;

    public function process(array $data, int $interval) {

        $this->numArgs = func_num_args();
        $this->getArgs = func_get_args();
        $string = null;
        $integer = array_map('intval', $this->getArgs);
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

        $directory_file = $this->getFile('header');
        $font = realpath(dirname(dirname(__FILE__)) . $this->getFile('font'));

        if (!file_exists($directory_file)) {

            $file = fopen($directory_file, "a+");
            $im = imagecreate(1021, 24);
            imagecolorallocate($im, 29, 122, 251);
            $text_color = imagecolorallocate($im, 255, 255, 255);
            imagettftext($im, 9, 0, 10, 17, $text_color, $font, $string);
            imagepng($im, $file);
            imagedestroy($im);
        }
    }
}


