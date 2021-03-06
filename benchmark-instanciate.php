<?php

namespace App\Infrastructure\Persistence\Doctrine\Utils;

define('TESTS_RUNS', 1000000);
define('ONE_MILION', 1000000);

class ReflectionService
{
    /**
     * @param string $class
     * @param array  $propertiesKeyValueList
     *
     * @return object
     * @throws \ReflectionException
     */
    public static function createObject(string $class, array $propertiesKeyValueList = [])
    {
        $refClass = (new \ReflectionClass($class));
        $refObject = $refClass->newInstanceWithoutConstructor();
        foreach ($propertiesKeyValueList as $key => $value) {
            $property = $refClass->getProperty($key);
            $property->setAccessible(true);
            $property->setValue($refObject, $value);
        }
        return $refObject;
    }

    /**
     * @param object $object
     * @param string $propertyName
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public static function extractPrivateValue($object, string $propertyName)
    {
        $reflectionClass = new \ReflectionClass($object);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
}

class KanapaWithChecks
{
    const TYPES = ['naroznikowa', 'babciowa', 'bogacza'];

    private string $color;

    private string $type;

    private int $width;

    private int $depth;

    private int $height;

    public function __construct(
        string $color,
        string $type,
        int $width,
        int $depth,
        int $height
    ) {
        if (!in_array($type, static::TYPES)) {
            throw new \Exception('Nie ma takich kanap.');
        }

        $this->color = $color;
        $this->type = $type;
        $this->width = $width;
        $this->depth = $depth;
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function color(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function depth(): int
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }
}

class Kanapa
{
    private string $color;

    private string $type;

    private int $width;

    private int $depth;

    private int $height;

    public function __construct(
        string $color,
        string $type,
        int $width,
        int $depth,
        int $height
    ) {
        $this->color = $color;
        $this->type = $type;
        $this->width = $width;
        $this->depth = $depth;
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function color(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function depth(): int
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }
}

// test
$meanTimeInstNoIf = 0;

echo "\n";
for ($i=0; $i<TESTS_RUNS; $i++) {
    $start = microtime(true);
    $kanapa = new Kanapa(
        'rozowy',
        'naroznikowa',
        1,1,1
    );

    $end = microtime(true);

    $diff = $end-$start;
    $meanTimeInstNoIf += $diff;
}

echo "\n";
echo "Instatiate object NO-IF mean time: " . number_format(ONE_MILION*($meanTimeInstNoIf/TESTS_RUNS), 4) . " µsec\n";
