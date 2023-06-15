<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'tests')
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src')
    ->append(['.php-cs-fixer.php']);

$rules = [
    '@Symfony'                => true,
    'phpdoc_no_empty_return'  => false,
    'array_syntax'            => ['syntax' => 'short'],
    'yoda_style'              => false,
    'binary_operator_spaces'  => [
        'operators' => [
            '=>' => 'align',
            '='  => 'align',
        ],
    ],
    'concat_space'            => ['spacing' => 'one'],
    'not_operator_with_space' => false,
    'increment_style'         => ['style' => 'post'],
    'no_unused_imports'       => true,
    'ordered_imports'         => [
        'sort_algorithm' => 'alpha',
        'imports_order'  => ['const', 'class', 'function'],
    ],
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed'       => true,
        'remove_inheritdoc' => false,
    ],
];

return (new PhpCsFixer\Config())
    ->setUsingCache(true)
    ->setRules($rules)
    ->setFinder($finder);
