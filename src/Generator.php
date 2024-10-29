<?php

namespace Geradrum\Curp;

use DateTime;
use Geradrum\Curp\Dictionaries\BlacklistDictionary;
use Geradrum\Curp\Dictionaries\VerificationDictionary;
use Geradrum\Curp\Models\Entity;

class Generator
{
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
     * Options.
     *
     * @var array
     */
    protected array $options;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $lastname
     * @param string $maternalLastname
     * @param DateTime $birthdate
     * @param Entity $entity
     * @param string $gender
     * @param array $options
     */
    public function __construct(string $name, string $lastname, string $maternalLastname, DateTime $birthdate, Entity $entity, string $gender, array $options = [])
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->maternalLastname = $maternalLastname;
        $this->birthdate = $birthdate;
        $this->entity = $entity;
        $this->gender = $gender;
        $this->curp = 'XXXXXXXXXXXXXXXXXX';
        $this->options = $options;
    }

    /**
     * Make.
     *
     * @param string $name
     * @param string $lastname
     * @param string $maternalLastname
     * @param DateTime $birthdate
     * @param Entity $entity
     * @param string $gender
     * @param array $options
     * @return self
     */
    public static function make(string $name, string $lastname, string $maternalLastname, DateTime $birthdate, Entity $entity, string $gender, array $options = []): self
    {
        return new self($name, $lastname, $maternalLastname, $birthdate, $entity, $gender, $options);
    }

    /**
     * Generate.
     *
     * @return string
     */
    public function generate(): string
    {
        $this->generateName();
        $this->generateLastname();
        $this->generateMaternalLastname();
        $this->generateBirthYear();
        $this->generateBirthMonth();
        $this->generateBirthDay();
        $this->generateGender();
        $this->generateEntity();
        $this->generateVerificationCode();
        $this->generateVerificationDigit();
        $this->normalize();

        return $this->curp;
    }

    /**
     * Generate name part.
     *
     * @return void
     */
    protected function generateName(): void
    {
        // First part
        $names = array_values(array_filter(explode(' ', $this->name), function ($name) {
            // Remove prepositions from name
            return ! in_array($name, BlacklistDictionary::prepositions());
        }));

        if (count($names) > 1 && in_array($names[0], BlacklistDictionary::names())) {
            // Remove "invalid" names when two or more names are present
            $names = array_values(array_filter($names, function ($name) {
                return ! in_array($name, BlacklistDictionary::names());
            }));
        }

        $this->curp = substr_replace($this->curp, substr($names[0], 0, 1), 3, 1);

        // Second part
        $consonant = substr($names[0], 1);
        $consonant = substr(preg_replace('/[AEIOU]/', '', $consonant), 0, 1) ?? 'X';

        $this->curp = substr_replace($this->curp, $consonant, 15, 1);
    }

    /**
     * Generate lastname part.
     *
     * @return void
     */
    protected function generateLastname(): void
    {
        $lastnames = array_values(array_filter(explode(' ', $this->lastname), function ($name) {
            // Remove prepositions from name
            return ! in_array($name, BlacklistDictionary::prepositions());
        }));

        $firstLetter = substr($lastnames[0], 0, 1);
        $firstVowel = substr(preg_replace('/[^AEIOU]/', '', $lastnames[0]), 0 ,1);
        $firstConsonant = substr(preg_replace('/[AEIOU]/', '', substr($lastnames[0], 1)), 0 ,1);

        // First part
        $this->curp = substr_replace($this->curp, $firstLetter, 0, 1);
        $this->curp = substr_replace($this->curp, $firstVowel, 1, 1);

        // Second part
        $this->curp = substr_replace($this->curp, $firstConsonant, 13, 1);

    }

    /**
     * Generate maternal lastname part.
     *
     * @return void
     */
    protected function generateMaternalLastname(): void
    {
        $replacement = 'X';

        if (empty($this->maternalLastname)) {
            $this->curp = substr_replace($this->curp, $replacement, 2, 1);
            $this->curp = substr_replace($this->curp, $replacement, 14, 1);
            return;
        }

        $maternalLastNames = array_values(array_filter(explode(' ', $this->maternalLastname), function ($name) {
            // Remove prepositions from name
            return ! in_array($name, BlacklistDictionary::prepositions());
        }));

        $firstLetter = substr($maternalLastNames[0], 0, 1);
        $firstConsonant = substr(preg_replace('/[AEIOU]/', '', substr($maternalLastNames[0], 1)), 0 ,1);

        // First part
        $this->curp = substr_replace($this->curp, $firstLetter, 2, 1);

        // Second part
        $this->curp = substr_replace($this->curp, $firstConsonant, 14, 1);

    }

    /**
     * Generate birth day part.
     *
     * @return void
     */
    protected function generateBirthDay(): void
    {
        $this->curp = substr_replace($this->curp, $this->birthdate->format('d'), 8, 2);
    }

    /**
     * Generate birth month part.
     *
     * @return void
     */
    protected function generateBirthMonth(): void
    {
        $this->curp = substr_replace($this->curp, $this->birthdate->format('m'), 6, 2);
    }

    /**
     * Generate birth month year.
     *
     * @return void
     */
    protected function generateBirthYear(): void
    {
        $this->curp = substr_replace($this->curp, $this->birthdate->format('y'), 4, 2);
    }

    /**
     * Generate gender.
     *
     * @return void
     */
    protected function generateGender(): void
    {
        $this->curp = substr_replace($this->curp, $this->gender, 10, 1);
    }

    /**
     * Generate entity.
     *
     * @return void
     */
    protected function generateEntity(): void
    {
        $this->curp = substr_replace($this->curp, $this->entity->getCode(), 11, 2);
    }

    /**
     * Generate verification code.
     *
     * @return void
     */
    protected function generateVerificationCode(): void
    {
        if (($this->options['verification_digits'] ?? null) === false) {
            return;
        }

        $code = (int) $this->birthdate->format('Y') < 2000 ? '0' : 'A';
        $this->curp = substr_replace($this->curp, $code, 16, 1);
    }

    /**
     * Generate verification digit.
     *
     * @return void
     */
    protected function generateVerificationDigit(): void
    {
        if (($this->options['verification_digits'] ?? null) === false) {
            return;
        }

        $counter = 18;
        $sum = 0;
        $number = 0;

        for ($i = 0; $i < strlen($this->curp); $i++)
        {
            $index = $this->curp[$i];

            foreach (VerificationDictionary::verificationDigits() as $key => $value) {
                if ($index === $key) {
                    $number = ($value * $counter);
                }
            }

            $counter -= 1;
            $sum = $sum + $number;
        }

        $digit = $sum % 10;
        $digit = abs(10 - $digit);
        $digit = $digit === 10 ? 0 : $digit;

        $this->curp = substr_replace($this->curp, $digit, 17, 1);
    }

    /**
     * Replace bad word.
     *
     * @param $string
     * @return string
     */
    protected function replaceBadWord($string): string
    {
        foreach (BlacklistDictionary::badWords() as $badWord) {
            if (strpos($string, $badWord) !== false) {
                $string = str_replace(
                    $badWord,
                    substr_replace($badWord, 'X', 1, 1),
                    $string
                );
            }
        }

        return $string;
    }

    /**
     * Normalize.
     *
     * @return void
     */
    protected function normalize(): void
    {
        $this->curp = $this->replaceBadWord($this->curp);
    }
}