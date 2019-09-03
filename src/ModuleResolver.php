<?php

declare(strict_types=1);

namespace NunoMaduro\Yorn;

use Closure;
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
     * @param  Closure | string  $exportable
     *
     * @return string
     */
    public static function resolve($exportable): string
    {
        $reflectionExportable = $exportable instanceof Closure ? self::resolveClosure($exportable) : self::resolveClass($exportable);

        return  (string) realpath( (string) $reflectionExportable->getFileName());
    }

    public static function resolveClosure(Closure $closure): ReflectionFunction  {
        return new ReflectionFunction($closure);
    }

    public static function resolveClass(string $class): ReflectionClass {
        return new ReflectionClass($class);
    }
}
