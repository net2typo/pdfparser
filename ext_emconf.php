<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Smalot PDF Parser',
    'description' => 'Official Smalot PDF Parser library for TYPO3 CMS. Can read and extract text and metadata from PDF files.',
    'category' => 'misc',
    'author' => 'NET2TYPO WEB SERVICES',
    'author_email' => 'support@net2typo.com',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '2.12.5',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-14.4.99',
            'php' => '8.1.0-8.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Smalot\\PdfParser\\' => 'src/Smalot/PdfParser',
        ],
    ],
];
