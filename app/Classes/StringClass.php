<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StringClass {

    private $max_string = 38;
    private $real_string;
    private $array_result = array();
    
    public function __construct($realString, $maxString) {
        $this->max_string = $maxString;
        $this->real_string = $realString;
	}

    public function explode_string($str) {
        $check_char = $this->check_char_max($str);
        $check_rest = $this->check_char_rest();

        return $this->result();
	}

    private function check_char_max($str) {
        if (strlen($str) > $this->max_string) {
            $string = explode(' ', $str);
            $string = join(' ', array_slice($string, 0, -1));
            return $this->check_char_max($string);
        }
        else {
            $this->array_result[] = $str;
            return $str;
        }
    }

    private function check_char_rest() {
        $count_source = count(explode(' ', $this->real_string));
        $result = '';
        foreach($this->array_result as $key => $val) {
            $result .= $val;
            if (($key+1) != count($this->array_result)) $result .= ' ';
        }
        $count_result = count(explode(' ', $result));
        if ($count_source != $count_result) {
            $string = explode(' ', $this->real_string);
            $string = join(' ', array_slice($string, $count_result, null));
            return $this->explode_string($string);
        }
    }

    private function result() {
        return $this->array_result;
    }

}
?>