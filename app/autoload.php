<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
AnnotationRegistry::registerFile(__DIR__."/../vendor/silexlabs/amfphp/Amfphp/ClassLoader.php");
AnnotationRegistry::registerFile(__DIR__."/../vendor/silexlabs/amfphp/Amfphp/Core/Common/ClassFindInfo.php");

return $loader;
