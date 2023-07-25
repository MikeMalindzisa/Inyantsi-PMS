<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ecf4e65199a2557b0dcc656f018df01
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ecf4e65199a2557b0dcc656f018df01::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ecf4e65199a2557b0dcc656f018df01::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ecf4e65199a2557b0dcc656f018df01::$classMap;

        }, null, ClassLoader::class);
    }
}