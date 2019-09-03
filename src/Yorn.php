<?php

declare(strict_types=1);

namespace NunoMaduro\Yorn;

use Closure;

/**
 * @internal
 */
final class Yorn
{
    /**
     * Holds the resolved modules.
     *
     * @var array<string, Closure | string>
     */
    private static $modules = [];

    /**
     * Registers the given exportable as module.
     *
     * @param  Closure | string  $exportable
     *
     * @return void
     */
    public static function export($exportable): void
    {
        $module = ModuleResolver::resolve($exportable);

        if (! array_key_exists($module, self::$modules)) {
            self::$modules[$module] = $exportable;
        }
    }

    /**
     * Registers the given module, that may be a relative module.
     *
     * @param  string  $module
     *
     * @return Closure|string|object
     */
    public static function import(string $module)
    {
        $folder = dirname(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['file']);

        $module = "$folder/$module";

        if (file_exists($module . '.php')) {
            $module = realpath($module. '.php');

            if (! array_key_exists((string) $module, self::$modules)) {
                require $module;
            }

            return self::$modules[$module];
        } else {
            $modules = new \stdClass();

            foreach ((array) glob("$module/*.php") as $foundModule) {
                $foundModule = realpath((string) $foundModule);
                if (! array_key_exists((string) $foundModule, self::$modules)) {
                    require $foundModule;
                }

                $modules->{explode('.php', basename($foundModule))[0]} = self::$modules[$foundModule];
            }

            return $modules;
        }
    }

    /**
     * Resolves the given `module`.
     *
     * @param  string  $module
     *
     * @return Closure | string
     */
    public static function resolve(string $module)
    {
        return self::$modules[realpath($module)];
    }
}
