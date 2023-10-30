<?php

namespace App\Actions;

class StoreEquipmentTypeActions
{
    public static function prepareData($data, $sn)
    {
        $digit = str_split('123456789');
        $highCharacter = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $smallCharacter = str_split('abcdefghijklmnopqrstuvwxyz');
        $intOrCharacter = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $simbol = str_split('-_@');



        $value = [];
        $array = str_split($data);
        $serialNumbers = str_split($sn);

        foreach ($array as $key => $type) {
            if($type == 'X') {
                if (in_array($serialNumbers[$key], $intOrCharacter)) {
                    $value[] = $serialNumbers[$key];
                };
            }
            elseif ($type == 'N') {
                if (in_array($serialNumbers[$key], $digit)) {
                    $value[] = $serialNumbers[$key];
                };
            }
            elseif ($type == 'A') {
                if (in_array($serialNumbers[$key], $highCharacter)) {
                    $value[] = $serialNumbers[$key];
                };
            }
            elseif ($type == 'a') {
                if (in_array($serialNumbers[$key], $smallCharacter)) {
                    $value[] = $serialNumbers[$key];
                };
            }
            elseif ($type == 'Z') {
                if (in_array($serialNumbers[$key], $simbol)) {
                    $value[] = $serialNumbers[$key];
                };
            }
        }
        return implode($value);
    }

    public function validMask($mask, $dataArray)
    {
        $temp = [];
        foreach ($dataArray as $key => $item) {
            if (strlen(StoreEquipmentTypeActions::prepareData($mask, $item)) == 10) {
                $temp[] = StoreEquipmentTypeActions::prepareData($mask, $item);
            };
        }

        return array_unique($temp);
    }
}
