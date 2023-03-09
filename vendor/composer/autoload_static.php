<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit46c269b81911b07073f08c92722c1800
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/hyperf/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit46c269b81911b07073f08c92722c1800::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit46c269b81911b07073f08c92722c1800::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit46c269b81911b07073f08c92722c1800::$classMap;

        }, null, ClassLoader::class);
    }
}
