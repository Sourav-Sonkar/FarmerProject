<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7597e2e06e53db2b75f24f469a42e718
{
    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit7597e2e06e53db2b75f24f469a42e718::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
