<?php

require __DIR__ . '/vendor/autoload.php';

use Geradrum\Curp\Curp;
use Geradrum\Curp\Models\Entity;
use Geradrum\Curp\Models\Gender;

try {
    // Instantiate the Curp class
    $curp = new Curp([
        'name' => 'Juan',
        'lastname' => 'Pérez',
        'maternal_lastname' => 'García',
        'birthdate' => '1990-05-15',
        'entity' => Entity::JALISCO,
        'gender' => Gender::MALE,
    ], [ // Optional parameter
        'verification_digits' => true, // Set false to keep verification digits as XX
    ]);

    // Output the generated CURP
    echo "Generated CURP: " . $curp->getCurp() . "\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}