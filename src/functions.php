<?php

declare(strict_types=1);

use NunoMaduro\Yorn\Yorn;

(function () {
    function import(string $module)
    {
        return Yorn::import($module);
    }

    function export($exportable): void
    {
        Yorn::export($exportable);
    }
})();
