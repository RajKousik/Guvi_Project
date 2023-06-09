<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6e15352eb25e560dd6af0d862befc9aa
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6e15352eb25e560dd6af0d862befc9aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6e15352eb25e560dd6af0d862befc9aa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6e15352eb25e560dd6af0d862befc9aa::$classMap;

        }, null, ClassLoader::class);
    }
}
