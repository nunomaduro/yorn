<?php

declare(strict_types=1);

use NunoMaduro\Yorn\Yorn;

(function () {
    function import(string $module)
    {
        return Yorn::import($module);
    }

    function export(callable $callable): void
    {
        Yorn::export($callable);
    }
})();
