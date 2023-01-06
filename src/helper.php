<?php

declare(strict_types=1);

namespace Faker;

if (!function_exists('fakeNIK')) {
    function fakeNIK(): NIK
    {
        return (new NIK(0, 0, 0, 0, 0, 0))->randAll();
    }
}
