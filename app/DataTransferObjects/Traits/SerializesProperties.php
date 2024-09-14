<?php

namespace App\DataTransferObjects\Traits;

use ReflectionClass;
use ReflectionProperty;

trait SerializesProperties
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $refl = new ReflectionClass($this);
        $arr = [];
        foreach ($refl->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            if ($prop->isStatic()) {
                continue;
            }
            $arr[$prop->getName()] = $prop->getValue($this);
        }

        return $arr;
    }
}
