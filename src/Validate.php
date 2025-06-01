<?php

namespace Ngomafortuna\Validate;

/**
 * <b>Validate</b>
 * This class is a helper, to filter_var/datas comming oh form with base in FILTER_SANITIZE
 * 
 * copyright (c) 2025, ngoma m. fortuna of the mostarda tec
 */
class Validate
{
    public static function get(array $fields, array $data): array {
            
        $validate = [];

        foreach($fields as $field => $type) {

            $value = trim($data[$field]); // remove space before end after phrase

            match($type) {
                's' =>  $validate[$field] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS), // or FILTER_SANITIZE_FULL_SPECIAL_CHARS
                'i' =>  $validate[$field] = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT),
                'e' =>  $validate[$field] = filter_var($value, FILTER_SANITIZE_EMAIL),
                'u' =>  $validate[$field] = filter_var($value, FILTER_SANITIZE_URL),
                'b' =>  $validate[$field] = ($data[$field]=='on')? 1: 0, // bool 
                '*' =>  $validate[$field] = $data[$field] // no chang
            };
        }

        // remove sanitized item of the array $data
		foreach(array_keys($data) as $index) {
			if(in_array($index, array_keys($validate))) unset($data[$index]);
		}

        return array_merge($validate, $data);
    }

}