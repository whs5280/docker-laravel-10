<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8916053c8d44f18b05dcf9043fdaa4e3
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../../vendor/nesbot/carbon/src/Carbon',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/..',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8916053c8d44f18b05dcf9043fdaa4e3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8916053c8d44f18b05dcf9043fdaa4e3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8916053c8d44f18b05dcf9043fdaa4e3::$classMap;

        }, null, ClassLoader::class);
    }
}