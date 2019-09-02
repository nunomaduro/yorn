<?php

declare(strict_types=1);

namespace NunoMaduro\Yorn;

/**
 * @internal
 */
final class Yorn
{
    /**
     * Holds the resolved modules.
     *
     * @var array<string, callable | string>
     */
    private static $modules = [];

    /**
     * Registers the given exportable as module.
     *
     * @param  callable | string  $exportable
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
     * @return callable|object
     */
    public static function import(string $module)
    {
        $folder = dirname(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['file']);

        $module = "$folder/$module";

        if (file_exists($module . '.php')) {
            $module = realpath($module. '.php');

            if (! array_key_exists($module, self::$modules)) {
                require $module;
            }

            return self::$modules[$module];
        } else {
            $modules = new \stdClass();

            foreach (glob("$module/*.php") as $module) {
                $module = realpath($module);
                if (! array_key_exists($module, self::$modules)) {
                    require $module;
                }

                $modules->{explode('.php', basename($module))[0]} = self::$modules[$module];
            }

            return $modules;
        }
    }

    /**
     * Resolves the given `module`.
     *
     * @param  string  $module
     *
     * @return callable | string
     */
    public static function resolve(string $module)
    {
        return self::$modules[realpath($module)];
    }
}
