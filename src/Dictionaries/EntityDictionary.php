<?php

namespace Geradrum\Curp\Dictionaries;

class EntityDictionary
{
    /**
     * Entities.
     *
     * @var array|array[]
     */
    protected static array $entities = [
         1 => ['name' => 'AGUASCALIENTES',                   'code' => 'AS'],
         2 => ['name' => 'BAJA CALIFORNIA',                  'code' => 'BC'],
         3 => ['name' => 'BAJA CALIFORNIA SUR',              'code' => 'BS'],
         4 => ['name' => 'CAMPECHE',                         'code' => 'CC'],
         5 => ['name' => 'COAHUILA',                         'code' => 'CL'],
         6 => ['name' => 'COLIMA',                           'code' => 'CM'],
         7 => ['name' => 'CHIAPAS',                          'code' => 'CS'],
         8 => ['name' => 'CHIHUAHUA',                        'code' => 'CH'],
         9 => ['name' => 'DISTRITO FEDERAL',                 'code' => 'DF'],
        10 => ['name' => 'DURANGO',                          'code' => 'DG'],
        11 => ['name' => 'GUANAJUATO',                       'code' => 'GT'],
        12 => ['name' => 'GUERRERO',                         'code' => 'GR'],
        13 => ['name' => 'HIDALGO',                          'code' => 'HG'],
        14 => ['name' => 'JALISCO',                          'code' => 'JC'],
        15 => ['name' => 'ESTADO DE MEXICO',                 'code' => 'MC'],
        16 => ['name' => 'MICHOACAN',                        'code' => 'MN'],
        17 => ['name' => 'MORELOS',                          'code' => 'MS'],
        18 => ['name' => 'NAYARIT',                          'code' => 'NT'],
        19 => ['name' => 'NUEVO LEON',                       'code' => 'NL'],
        20 => ['name' => 'OAXACA',                           'code' => 'OC'],
        21 => ['name' => 'PUEBLA',                           'code' => 'PL'],
        22 => ['name' => 'QUERETARO',                        'code' => 'QT'],
        23 => ['name' => 'QUINTANA ROO',                     'code' => 'QR'],
        24 => ['name' => 'SAN LUIS POTOSI',                  'code' => 'SP'],
        25 => ['name' => 'SINALOA',                          'code' => 'SL'],
        26 => ['name' => 'SONORA',                           'code' => 'SR'],
        27 => ['name' => 'TABASCO',                          'code' => 'TC'],
        28 => ['name' => 'TAMAULIPAS',                       'code' => 'TS'],
        29 => ['name' => 'TLAXCALA',                         'code' => 'TL'],
        30 => ['name' => 'VERACRUZ',                         'code' => 'VZ'],
        31 => ['name' => 'YUCATAN',                          'code' => 'YN'],
        32 => ['name' => 'ZACATECAS',                        'code' => 'ZS'],
        98 => ['name' => 'DOBLE NACIONALIDAD',               'code' => 'NE'],
        99 => ['name' => 'NACIDO EXTRANJERO O NATURALIZADO', 'code' => 'NE'],
    ];

    /**
     * Get all entities.
     *
     * @return array[]
     */
    public static function getAll(): array
    {
        return self::$entities;
    }

    /**
     * Get entity by code.
     *
     * @param int $code
     * @return array|null
     */
    public static function getEntity(int $code): ?array
    {
        return self::$entities[$code] ?? null;
    }
}
