<?php

declare(strict_types=1);

use NunoMaduro\Yorn\Yorn;

(function () {
    /**
     * @param  string  $module
     * 
     * @return Closure|string|object
     */
    function import(string $module)
    {
        return Yorn::import($module);
    }

    /**
     * @param  Closure | string  $exportable
     *
     * @return void
     */
    function export($exportable): void
    {
        Yorn::export($exportable);
    }
})();
