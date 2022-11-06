<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc164bc8a48e45055a066a009476b38b
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Services\\' => 9,
            'Server\\' => 7,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
            'Configs\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Services',
        ),
        'Server\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Server',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
        'Configs\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Configs',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc164bc8a48e45055a066a009476b38b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc164bc8a48e45055a066a009476b38b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc164bc8a48e45055a066a009476b38b::$classMap;

        }, null, ClassLoader::class);
    }
}
