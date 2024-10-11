<?php

namespace Geradrum\Curp\Dictionaries;

class BlacklistDictionary
{
    /**
     * Bad words.
     *
     * @var array|string[]
     */
    protected static array $badWords = [
        'BACA',
        'BAKA',
        'BUEI',
        'BUEY',
        'CACA',
        'CACO',
        'CAGA',
        'CAGO',
        'CAKA',
        'CAKO',
        'COGE',
        'COGI',
        'COJA',
        'COJE',
        'COJI',
        'COJO',
        'COLA',
        'CULO',
        'FALO',
        'FETO',
        'GETA',
        'GUEI',
        'GUEY',
        'JETA',
        'JOTO',
        'KACA',
        'KACO',
        'KAGA',
        'KAGO',
        'KAKA',
        'KAKO',
        'KOGE',
        'KOGI',
        'KOJA',
        'KOJE',
        'KOJI',
        'KOJO',
        'KOLA',
        'KULO',
        'LILO',
        'LOCA',
        'LOCO',
        'LOKA',
        'LOKO',
        'MAME',
        'MAMO',
        'MEAR',
        'MEAS',
        'MEON',
        'MIAR',
        'MION',
        'MOCO',
        'MOKO',
        'MULA',
        'MULO',
        'NACA',
        'NACO',
        'PEDA',
        'PEDO',
        'PENE',
        'PIPI',
        'PITO',
        'POPO',
        'PUTA',
        'PUTO',
        'QULO',
        'RATA',
        'ROBA',
        'ROBE',
        'ROBO',
        'RUIN',
        'SENO',
        'TETA',
        'VACA',
        'VAGA',
        'VAGO',
        'VAKA',
        'VUEI',
        'VUEY',
        'WUEI',
        'WUEY',
    ];

    /**
     * Omitted names.
     *
     * @var array|string[]
     */
    protected static array $names = [
        'JOSE',
        'MARIA',
        'J',
        'MA',
    ];

    /**
     * Prepositions.
     *
     * @var array|string[]
     */
    protected static array $prepositions = [
        'DA',
        'DAS',
        'DE',
        'DEL',
        'DER',
        'DI',
        'DIE',
        'DD',
        'EL',
        'LA',
        'LOS',
        'LAS',
        'LE',
        'LES',
        'MAC',
        'MC',
        'VAN',
        'VON',
        'Y',
    ];

    /**
     * Replacement characters.
     *
     * @var array|string[]
     */
    protected static array $replaceChars = [
        'Š'=>'S',
        'š'=>'s',
        'Ž'=>'Z',
        'ž'=>'z',
        'À'=>'A',
        'Á'=>'A',
        'Â'=>'A',
        'Ã'=>'A',
        'Ä'=>'A',
        'Å'=>'A',
        'Æ'=>'A',
        'Ç'=>'C',
        'È'=>'E',
        'É'=>'E',
        'Ê'=>'E',
        'Ë'=>'E',
        'Ì'=>'I',
        'Í'=>'I',
        'Î'=>'I',
        'Ï'=>'I',
        'Ò'=>'O',
        'Ó'=>'O',
        'Ô'=>'O',
        'Õ'=>'O',
        'Ö'=>'O',
        'Ø'=>'O',
        'Ù'=>'U',
        'Ú'=>'U',
        'Û'=>'U',
        'Ü'=>'U',
        'Ý'=>'Y',
        'Þ'=>'B',
        'ß'=>'Ss',
        'à'=>'a',
        'á'=>'a',
        'â'=>'a',
        'ã'=>'a',
        'ä'=>'a',
        'å'=>'a',
        'æ'=>'a',
        'ç'=>'c',
        'è'=>'e',
        'é'=>'e',
        'ê'=>'e',
        'ë'=>'e',
        'ì'=>'i',
        'í'=>'i',
        'î'=>'i',
        'ï'=>'i',
        'ð'=>'o',
        'ò'=>'o',
        'ó'=>'o',
        'ô'=>'o',
        'õ'=>'o',
        'ö'=>'o',
        'ø'=>'o',
        'ù'=>'u',
        'ú'=>'u',
        'û'=>'u',
        'ü'=>'u',
        'ý'=>'y',
        'þ'=>'b',
        'ÿ'=>'y',
    ];

    /**
     * Get bad words.
     *
     * @return array|string[]
     */
    public static function badWords(): array
    {
        return self::$badWords;
    }

    /**
     * Get omitted names.
     *
     * @return array|string[]
     */
    public static function names(): array
    {
        return self::$names;
    }

    /**
     * Get prepositions.
     *
     * @return array|string[]
     */
    public static function prepositions(): array
    {
        return self::$prepositions;
    }

    /**
     * Get replacement chars.
     *
     * @return array|string[]
     */
    public static function replacementChars(): array
    {
        return self::$replaceChars;
    }

    /**
     * Get single replacement character.
     *
     * @param $char
     * @return string
     */
    public static function getReplacementChar($char): string
    {
        if (in_array($char, array_keys(self::$replaceChars))) {
            return self::$replaceChars[$char];
        }

        return $char;
    }
}