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
     * @var array<string, callable>
     */
    private static $modules = [];

    /**
     * Registers the given callable as module.
     *
     * @param  callable  $callable
     *
     * @return void
     */
    public static function export(callable $callable): void
    {
        $module = ModuleResolver::resolve($callable);

        if (! array_key_exists($module, self::$modules)) {
            self::$modules[$module] = $callable;

            $name = explode('.php', basename($module))[0];

            eval("function $name(...\$args) {
                return \NunoMaduro\Yorn\Yorn::resolve('$module')(...\$args);
            }");
        }
    }

    /**
     * Registers the given module, that may be a relative module.
     *
     * @param  string  $module
     *
     * @return void
     */
    public static function import(string $module): void
    {
        $folder = dirname(realpath(debug_backtrace()[1]['file']));

        $module = "$folder/$module";

        if (file_exists($module . '.php')) {
            $modules = [$module . '.php'];
        } else {
            $modules = glob("$module/*.php");
        }

        foreach ($modules as $module) {
            if (! array_key_exists($module, self::$modules)) {
                require $module;
            }
        }
    }

    /**
     * Resolves the given `module`.
     *
     * @param  string  $module
     *
     * @return callable
     */
    public static function resolve(string $module): callable
    {
        return self::$modules[realpath($module)];
    }
}
