<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfbcab7945c56557bd71c4d515ad63861
{
    public static $files = array (
        'e06d01a98344e99070075b1de5dc2f91' => __DIR__ . '/..' . '/tawba/push-notification/src/Helpers/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tawba\\PushNotification\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tawba\\PushNotification\\' => 
        array (
            0 => __DIR__ . '/..' . '/tawba/push-notification/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfbcab7945c56557bd71c4d515ad63861::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfbcab7945c56557bd71c4d515ad63861::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
