<?php

it('imports functions', function () {
    $foo = import('../fixtures/functionType');

    assertEquals($foo(), 'bar');
});

it('uses exports file', function () {
    $concerns = import('../fixtures/concerns');
    $bob = $concerns->bob;

    assertEquals($bob(1), 1);
});
