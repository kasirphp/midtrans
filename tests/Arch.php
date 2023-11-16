<?php

test('not using dd() or dump()')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();
