<?php

namespace Geradrum\Curp;

use DateTime;
use Geradrum\Curp\Models\Entity;
use InvalidArgumentException;

class Curp
{
    /**
     * Required fields.
     *
     * @var array|string[]
     */
    protected array $requiredFields = [
        'name',
        'lastname',
        'birthdate',
        'entity',
        'gender',
    ];

    /**
     * Name.
     *
     * @var string
     */
    protected string $name;

    /**
     * Lastname.
     *
     * @var string
     */
    protected string $lastname;

    /**
     * Maternal lastname.
     *
     * @var ?string
     */
    protected ?string $maternalLastname = null;

    /**
     * Birthdate.
     *
     * @var DateTime
     */
    protected DateTime $birthdate;

    /**
     * Entity.
     *
     * @var Entity
     */
    protected Entity $entity;

    /**
     * Gender.
     *
     * @var string
     */
    protected string $gender;

    /**
     * CURP.
     *
     * @var string
     */
    protected string $curp;

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        // Validate that all required fields are present
        foreach ($this->requiredFields as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("Field '{$field}' is required.");
            }
        }

        foreach ($data as $field => $value) {
            $this->validateField($field, $value);
        }

        $this->name = normalize(mb_strtoupper($data['name']));
        $this->lastname = normalize(mb_strtoupper($data['lastname']));
        $this->maternalLastname = normalize(mb_strtoupper($data['maternal_lastname'])) ?? null;
        $this->birthdate = DateTime::createFromFormat('Y-m-d', $data['birthdate']);
        $this->entity = new Entity($data['entity']);
        $this->gender = $data['gender'];

        $this->curp = $this->generateCurp(
            $this->name,
            $this->lastname,
            $this->maternalLastname,
            $this->birthdate,
            $this->entity,
            $this->gender,
        );
    }

    /**
     * Make.
     *
     * @param array $data
     * @return self
     */
    public function make(array $data): self
    {
        return new static($data);
    }

    protected function validateField(string $field, $value): void
    {
        if (! Validator::validate($field, $value)) {
            throw new InvalidArgumentException("Invalid value '$value' for field '{$field}'.");
        }
    }

    /**
     * CURP generator.
     *
     * @param string $name
     * @param string $lastname
     * @param string $maternalLastname
     * @param DateTime $birthdate
     * @param Entity $entity
     * @param string $gender
     * @return string
     */
    protected function generateCurp(string $name, string $lastname, string $maternalLastname, DateTime $birthdate, Entity $entity, string $gender): string
    {
        return Generator::make($name, $lastname, $maternalLastname, $birthdate, $entity, $gender)->generate();
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Get maternal lastname.
     *
     * @return string
     */
    public function getMaternalLastname(): string
    {
        return $this->maternalLastname;
    }

    /**
     * Get birthdate.
     *
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * Get entity.
     *
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Get CURP.
     *
     * @return string
     */
    public function getCurp(): string
    {
        return $this->curp;
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
            'lastname' => $this->lastname,
            'maternal_lastname' => $this->maternalLastname,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'entity' => $this->entity->toArray(),
            'gender' => $this->gender,
            'curp' => $this->curp,
        ];
    }
}