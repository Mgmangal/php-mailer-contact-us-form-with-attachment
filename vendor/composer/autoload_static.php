<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac0b65738509c1696e2a8a2518f7d112
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac0b65738509c1696e2a8a2518f7d112::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac0b65738509c1696e2a8a2518f7d112::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
