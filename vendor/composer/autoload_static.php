<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05abbbd0e41d281492c992ac3e92e98a
{
    public static $files = array (
        '1cfd2761b63b0a29ed23657ea394cb2d' => __DIR__ . '/..' . '/topthink/think-captcha/src/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\slog\\' => 11,
            'think\\composer\\' => 15,
            'think\\captcha\\' => 14,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'P' => 
        array (
            'Pheanstalk\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\slog\\' => 
        array (
            0 => __DIR__ . '/..' . '/luofei614/socketlog/php',
        ),
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\captcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-captcha/src',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
        'Pheanstalk\\' => 
        array (
            0 => __DIR__ . '/..' . '/pda/pheanstalk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit05abbbd0e41d281492c992ac3e92e98a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit05abbbd0e41d281492c992ac3e92e98a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}