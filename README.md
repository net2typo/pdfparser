# TYPO3 Smalot PDF Parser (`pdfparser`)

[![TYPO3](https://img.shields.io/badge/TYPO3-11.5%20%7C%2012.4%20%7C%2013.4%20%7C%2014.x-orange.svg)](https://typo3.org/)
[![PHP](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%20%7C%208.3%20%7C%208.4-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-LGPL--3.0--or--later-green.svg)](LICENSE.txt)
[![Extension Key](https://img.shields.io/badge/TER-pdfparser-brightgreen.svg)](https://extensions.typo3.org/extension/pdfparser)

The `pdfparser` extension packages the official, popular [`smalot/pdfparser`](https://github.com/smalot/pdfparser) library for **TYPO3 CMS**. It enables TYPO3 extensions, search crawlers, media processors, and AI/RAG tools to extract text and metadata from PDF files seamlessly.

---

## Features

- **100% Upstream Compatible**: Direct packaging of the official `smalot/pdfparser` engine.
- **Universal Compatibility**: Works on TYPO3 v11.5 LTS, v12.4 LTS, v13.4 LTS, and v14.x.
- **Dual-Mode Ready**: Fully functional in both Composer and Classic / Non-Composer (TER) installations.
- **Text & Metadata Extraction**: Extracts plain text, headers, author, title, page counts, and fonts.
- **Unicode Support**: Supports multi-byte encodings and international UTF-8 characters.
- **FAL Ready**: Easily extracts text from TYPO3 File Abstraction Layer (`FileInterface`) assets.

---

## Installation

### Composer (Recommended)

```bash
composer require smalot/pdfparser
```

### Non-Composer / TER (TYPO3 Extension Manager)

1. In the TYPO3 Backend, go to **Admin Tools > Extensions**.
2. Search for the extension key **`pdfparser`** and click **Install**.
3. Alternatively, download the `.zip` archive from [extensions.typo3.org](https://extensions.typo3.org/) and upload it.

---

## Declaring Dependency

If you are developing a TYPO3 extension that requires PDF parsing:

**In `composer.json`:**
```json
"require": {
    "smalot/pdfparser": "^2.12"
}
```

**In `ext_emconf.php`:**
```php
'constraints' => [
    'depends' => [
        'typo3' => '11.5.0-14.4.99',
        'pdfparser' => '2.12.0-2.12.99',
    ],
],
```

---

## Quick Usage in TYPO3

```php
<?php

use Smalot\PdfParser\Parser;
use TYPO3\CMS\Core\Utility\GeneralUtility;

// 1. Instantiate parser
$parser = GeneralUtility::makeInstance(Parser::class);

// 2. Parse a PDF file
$pdf = $parser->parseFile('/path/to/document.pdf');

// 3. Extract text
$text = $pdf->getText();

// 4. Retrieve metadata
$details = $pdf->getDetails();
$pageCount = $details['Pages'] ?? count($pdf->getPages());
```

### Parsing TYPO3 FAL File:

```php
use Smalot\PdfParser\Parser;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

public function parseFalFile(FileInterface $file): string
{
    $localPath = $file->getForLocalProcessing(false);
    $parser = GeneralUtility::makeInstance(Parser::class);
    $pdf = $parser->parseFile($localPath);
    return $pdf->getText();
}
```

---

## Documentation

Full official TYPO3 documentation is available in [`Documentation/Index.rst`](Documentation/Index.rst).

---

## License & Credits

- **Core Library**: [Sébastien Malot](https://github.com/smalot/pdfparser)
- **TYPO3 Extension**: Net2typo
- **License**: [LGPL-3.0-or-later](LICENSE.txt)
