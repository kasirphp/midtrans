<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->rules([
        DeclareStrictTypesRector::class,
        InlineConstructorDefaultToPropertyRector::class,
        FinalizeClassesWithoutChildrenRector::class,
    ]);
};
