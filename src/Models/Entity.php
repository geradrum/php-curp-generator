<?php

namespace Geradrum\Curp\Models;

use Geradrum\Curp\Dictionaries\EntityDictionary;
use InvalidArgumentException;

class Entity extends Model
{
    /**
     * Aguascalientes
     */
    public const AGUASCALIENTES = 1;

    /**
     * Baja California
     */
    public const BAJA_CALIFORNIA = 2;

    /**
     * Baja California Sur
     */
    public const BAJA_CALIFORNIA_SUR = 3;

    /**
     * Campeche
     */
    public const CAMPECHE = 4;

    /**
     * Coahuila
     */
    public const COAHUILA = 5;

    /**
     * Colima
     */
    public const COLIMA = 6;

    /**
     * Chiapas
     */
    public const CHIAPAS = 7;

    /**
     * Chihuahua
     */
    public const CHIHUAHUA = 8;

    /**
     * Distrito Federal
     */
    public const DISTRITO_FEDERAL = 9;

    /**
     * Durango
     */
    public const DURANGO = 10;

    /**
     * Guanajuato
     */
    public const GUANAJUATO = 11;

    /**
     * Guerrero
     */
    public const GUERRERO = 12;

    /**
     * Hidalgo
     */
    public const HIDALGO = 13;

    /**
     * Jalisco
     */
    public const JALISCO = 14;

    /**
     * Estado De Mexico
     */
    public const ESTADO_DE_MEXICO = 15;

    /**
     * Michoacan
     */
    public const MICHOACAN = 16;

    /**
     * Morelos
     */
    public const MORELOS = 17;

    /**
     * Nayarit
     */
    public const NAYARIT = 18;

    /**
     * Nuevo Leon
     */
    public const NUEVO_LEON = 19;

    /**
     * Oaxaca
     */
    public const OAXACA = 20;

    /**
     * Puebla
     */
    public const PUEBLA = 21;

    /**
     * Queretaro
     */
    public const QUERETARO = 22;

    /**
     * Quintana Roo
     */
    public const QUINTANA_ROO = 23;

    /**
     * San Luis Potosi
     */
    public const SAN_LUIS_POTOSI = 24;

    /**
     * Sinaloa
     */
    public const SINALOA = 25;

    /**
     * Sonora
     */
    public const SONORA = 26;

    /**
     * Tabasco
     */
    public const TABASCO = 27;

    /**
     * Tamaulipas
     */
    public const TAMAULIPAS = 28;

    /**
     * Tlaxcala
     */
    public const TLAXCALA = 29;

    /**
     * Veracruz
     */
    public const VERACRUZ = 30;

    /**
     * Yucatan
     */
    public const YUCATAN = 31;

    /**
     * Zacatecas
     */
    public const ZACATECAS = 32;

    /**
     * Doble nacionalidad (DN)
     */
    public const DOBLE_NACIONALIDAD = 98;

    /**
     * Nacido extranjero o naturalizado (NE/N)
     */
    public const NACIDO_EXTRANJERO_O_NATURALIZADO = 99;

    /**
     * Entity name.
     *
     * @var string
     */
    protected string $name;

    /**
     * Entity code.
     *
     * @var string
     */
    protected string $code;


    /**
     * Constructor.
     *
     * @param int $code
     */
    public function __construct(int $code)
    {
        $entity = EntityDictionary::getEntity($code);

        if (is_null($entity)) {
            throw new InvalidArgumentException("Invalid entity code: '$code'");
        }

        return parent::__construct($entity);
    }

    /**
     * Get all entities.
     *
     * @return array
     */
    public static function all(): array
    {
        $entities = [];

        foreach (EntityDictionary::getAll() as $code => $entity) {
            $entities[] = new self($code);
        }

        return $entities;
    }

    /**
     * Get entity name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get entity code.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Serialize.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}