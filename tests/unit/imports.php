<?php

import('../../testFixtures/foo');
import('../../testFixtures/concerns');

it('imports modules', function () {
    assertEquals(foo(), 'bar');
});

it('uses exports file', function () {
    assertEquals(bob(1), 1);
});
