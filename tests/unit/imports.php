<?php

it('imports functions', function () {
    $foo = import('../fixtures/functionType');

    assertEquals($foo(), 'bar');
});

it('imports objects', function () {
    $foo = import('../fixtures/objectType');

    $instance = new $foo('world');
    
    assertEquals($instance->getMessage(), 'hello world');
});

it('uses exports file', function () {
    $concerns = import('../fixtures/concerns');
    $bob = $concerns->bob;

    assertEquals($bob(1), 1);
});
