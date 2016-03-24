<?php

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Dotenv\Dotenv;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

if ((int)getenv('USE_DOTENV') === 1 || php_sapi_name() === 'cli') {
    $env = new Dotenv(dirname(__DIR__));
    $env->load();
}

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
