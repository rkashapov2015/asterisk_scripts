<?php
namespace common;
class Helper {
    public static function getValueArray($array, $name, $defaultValue=null) {
        if(is_array($array)) {
            if(isset($array[$name]) && !empty($array[$name])) {
                return $array[$name];
            }
        }
        return $defaultValue;
    }
}
