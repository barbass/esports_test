<?php

require_once(__DIR__.'/Cache.php');
require_once(__DIR__.'/ParseXml.php');

$px = new ParseXml(__DIR__.'/data.xml');
$px->parse();
$px->saveToCache();
