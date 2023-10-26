<?php

namespace App\Actions;

/**
 *
 */
class StoreEquipmentTypeActions
{

    /**
     * @param $characters
     * @return string
     */
    private function randomCharacter($characters): string
    {
        $randomChar = '';

        for ($i = 0; $i < 1; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomChar .= $characters[$index];
        }

        return $randomChar;
    }

    /**
     * @param $length
     * @return string
     */
    public static function getMask($length = 10): string
    {
        $highCharacter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $smallCharacter = 'abcdefghijklmnopqrstuvwxyz';
        $intOrCharacter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomSimbol = '-_@';

        $N = rand(0, 9);
        $A = (new StoreEquipmentTypeActions)->randomCharacter($highCharacter);
        $a = (new StoreEquipmentTypeActions)->randomCharacter($smallCharacter);
        $X = (new StoreEquipmentTypeActions)->randomCharacter($intOrCharacter);
        $Z = (new StoreEquipmentTypeActions)->randomCharacter($randomSimbol);

        $stringSpace = $N . $A . $a . $X . $Z;
        $stringLength = strlen($stringSpace);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
        }
        return $randomString;
    }

}
