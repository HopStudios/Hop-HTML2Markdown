<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ba1bcdb117c71c9899d3deb819bcaea
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\HTMLToMarkdown\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\HTMLToMarkdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/html-to-markdown/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ba1bcdb117c71c9899d3deb819bcaea::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ba1bcdb117c71c9899d3deb819bcaea::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}