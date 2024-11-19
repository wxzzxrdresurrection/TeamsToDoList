<?php

namespace App\Helpers;

class RandomCharacterGenerator
{
    /**
     * Generate a random string of characters.
     *
     * @param int $length
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $numbers
     * @param bool $symbols
     * @return string
     */
    public static function generate(int $length = 12, bool $uppercase = true, bool $lowercase = true, bool $numbers = true, bool $symbols = false): string
    {
        $uppercaseCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercaseCharacters = 'abcdefghijklmnopqrstuvwxyz';
        $numberCharacters = '0123456789';
        $symbolCharacters = '!@#$%^&()_+[]{}*';

        $characters = '';
        $mandatoryCharacters = '';

        if ($uppercase) 
        {
            $characters .= $uppercaseCharacters;
            $mandatoryCharacters .= $uppercaseCharacters[random_int(0, strlen($uppercaseCharacters) - 1)];
        }

        if ($lowercase) 
        {
            $characters .= $lowercaseCharacters;
            $mandatoryCharacters .= $lowercaseCharacters[random_int(0, strlen($lowercaseCharacters) - 1)];
        }

        if ($numbers) 
        {
            $characters .= $numberCharacters;
            $mandatoryCharacters .= $numberCharacters[random_int(0, strlen($numberCharacters) - 1)];
        }

        if ($symbols) 
        {
            $characters .= $symbolCharacters;
            $mandatoryCharacters .= $symbolCharacters[random_int(0, strlen($symbolCharacters) - 1)];
        }

        $remainingLength = $length - strlen($mandatoryCharacters);
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $remainingLength; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $result = str_shuffle($mandatoryCharacters . $randomString);
        return $result;
    } 
}