<?php

declare(strict_types=1);

namespace NunoMaduro\Yorn;

use ReflectionClass;
use ReflectionFunction;

/**
 * @internal
 */
final class ModuleResolver
{
    /**
     * Resolve the FileName from the given `exportable`
     *
     * @param  callable | string  $exportable
     *
     * @return string
     */
    public static function resolve($exportable): string
    {
        $reflectionExportable = is_callable($exportable) ? new ReflectionFunction($exportable) : new ReflectionClass($exportable);

        return (string) realpath($reflectionExportable->getFileName());
    }
}
