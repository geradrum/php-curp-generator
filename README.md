# CURP Class Documentation

## Overview

The `Curp` class is designed to generate a CURP (Clave Única de Registro de Población) in Mexico based on the provided personal information. This class validates the required fields and constructs the CURP accordingly.

## Requirements

The class requires the following fields in the input data array:

- `name`: First name of the individual.
- `lastname`: Last name of the individual.
- `maternal_lastname`: Maternal last name (optional).
- `birthdate`: Birthdate in the format `YYYY-MM-DD`.
- `entity`: Entity object containing the corresponding state or entity information.
- `gender`: Gender of the individual.

## Example Usage

To use the `Curp` class, you need to create an instance of it with the required data. Below is an example of how to instantiate the class and generate a CURP.

### Example

```php
use Geradrum\Curp\Curp;
use Geradrum\Curp\Models\Entity;
use Geradrum\Curp\Models\Entity;

try {
    // Instantiate the Curp class
    $curp = new Curp([
        'name' => 'Juan',
        'lastname' => 'Pérez',
        'maternal_lastname' => 'García',
        'birthdate' => '1990-05-15',
        'entity' => Entity::JALISCO,
        'gender' => Gender::MALE, 
    ]);
    
    // Output the generated CURP
    echo "Generated CURP: " . $curp->getCurp() . "\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.




