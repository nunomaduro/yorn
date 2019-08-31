<?php

declare(strict_types=1);

namespace NunoMaduro\Yorn;

use ReflectionFunction;

/**
 * @internal
 */
final class ModuleResolver
{
    /**
     * Resolve the FileName from the given `callback`
     *
     * @param  callable  $callback
     *
     * @return string
     */
    public static function resolve(callable $callback): string
    {
        $reflectionClosure = new ReflectionFunction($callback);

        return (string) realpath($reflectionClosure->getFileName());
    }
}
