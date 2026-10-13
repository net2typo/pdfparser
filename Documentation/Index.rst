.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. _start:

=============================================================
Smalot PDF Parser for TYPO3
=============================================================

:Extension key:
   pdfparser

:Package name:
   smalot/pdfparser

:Version:
   2.12.5

:Description:
   Official Smalot PDF Parser library packaged for TYPO3 CMS. Reads and extracts text and metadata from PDF files.

:Language:
   en

:Author:
   Sebastien MALOT, Net2typo

:License:
   LGPL-3.0-or-later

:Rendered:
   |today|

-------------------------------------------------------------

What does it do?
================

The **pdfparser** extension packages the official, widely-used `smalot/pdfparser <https://github.com/smalot/pdfparser>`_ library into a native TYPO3 CMS extension.

It enables any TYPO3 extension (such as search indexers, media processors, document viewers, and AI/RAG ingestion tools) to easily read and extract plain text, metadata, page hierarchies, and font structures directly from PDF files.

Features
--------

- **100% Upstream Compatible**: Based directly on the official Smalot PDF Parser engine.
- **Universal TYPO3 Support**: Supports TYPO3 v11.5 LTS, v12.4 LTS, v13.4 LTS, and v14.x.
- **PHP 8.1 - 8.4 Ready**: Fully tested on modern PHP versions.
- **Dual-Mode Ready**: Fully functional in both Composer installations and Classic / Non-Composer (TER) installations.
- **FAL Compatible**: Can parse raw file paths, streams, or TYPO3 File Abstraction Layer (FAL) files.
- **Unicode & Multilingual**: Supports international UTF-8 characters and multi-byte text encoding.

Requirements
============

- TYPO3 CMS: ``^11.5 || ^12.4 || ^13.4 || ^14.0``
- PHP: ``>= 8.1``
- PHP Extensions: ``ext-zlib``, ``ext-iconv``, ``ext-mbstring``

Installation
============

Composer Mode (Recommended)
---------------------------

In modern TYPO3 projects using Composer, install via:

.. code-block:: bash

   composer require smalot/pdfparser

Non-Composer / TER Installation
--------------------------------

1. Open your TYPO3 Backend.
2. Navigate to **Admin Tools > Extensions**.
3. Search for the extension key **pdfparser** in the TYPO3 Extension Repository (TER).
4. Click **Install**.
5. Alternatively, download the extension ``.zip`` file from `extensions.typo3.org <https://extensions.typo3.org/>`_, extract it into ``typo3conf/ext/pdfparser`` (or ``packages/pdfparser``), and activate it.

Usage in TYPO3 Extensions
=========================

Declaring Dependency
--------------------

If your custom TYPO3 extension requires PDF text extraction:

1. **In ``composer.json``**:

   .. code-block:: json

      "require": {
          "smalot/pdfparser": "^2.12"
      }

2. **In ``ext_emconf.php``**:

   .. code-block:: php

      'constraints' => [
          'depends' => [
              'typo3' => '11.5.0-14.4.99',
              'pdfparser' => '2.12.0-2.12.99',
          ],
      ],

PHP Code Examples
-----------------

Example 1: Basic Text Extraction
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

   use Smalot\PdfParser\Parser;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   // Instantiate via TYPO3 GeneralUtility
   $parser = GeneralUtility::makeInstance(Parser::class);

   // Parse a PDF document
   $pdf = $parser->parseFile('/path/to/document.pdf');

   // Retrieve plain text content
   $text = $pdf->getText();

Example 2: Reading Metadata & Details
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

   use Smalot\PdfParser\Parser;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   $parser = GeneralUtility::makeInstance(Parser::class);
   $pdf = $parser->parseFile('/path/to/document.pdf');

   // Retrieve document details (Author, Title, Pages, Producer, etc.)
   $details = $pdf->getDetails();

   $pageCount = $details['Pages'] ?? count($pdf->getPages());
   $author = $details['Author'] ?? '';
   $title = $details['Title'] ?? '';

Example 3: Iterating Pages Individually
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

   use Smalot\PdfParser\Parser;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   $parser = GeneralUtility::makeInstance(Parser::class);
   $pdf = $parser->parseFile('/path/to/document.pdf');
   $pages = $pdf->getPages();

   foreach ($pages as $pageNumber => $page) {
       $pageText = $page->getText();
       // Process text per page
   }

Example 4: Parsing from TYPO3 FAL File Object
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php

   use Smalot\PdfParser\Parser;
   use TYPO3\CMS\Core\Resource\FileInterface;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   public function extractFromFal(FileInterface $file): string
   {
       $localPath = $file->getForLocalProcessing(false);
       if (!file_exists($localPath)) {
           return '';
       }

       $parser = GeneralUtility::makeInstance(Parser::class);
       $pdf = $parser->parseFile($localPath);
       return $pdf->getText();
   }

Credits & License
=================

- **Core Library**: Sébastien Malot (`GitHub Repository <https://github.com/smalot/pdfparser>`_).
- **TYPO3 Packaging**: Net2typo.
- **License**: LGPL-3.0-or-later.
