<?php

use Eliepse\WritingGrid\Models\LayoutModel;
use Eliepse\WritingGrid\WordList;

require_once __DIR__ . '/../vendor/autoload.php';

$rawWordList = include __DIR__ . '/../resources/list.php';

$list = new WordList();

foreach ($rawWordList as $rawWord) {
	$list->addWord($rawWord);
}

(new LayoutModel())->render($list);