<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4d5455324d6a45324d7a55304f413d3d
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Uzaweb\\Openexam\\Tests\\' => 25,
            'Uzaweb\\Openexam\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Uzaweb\\Nettools\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Uzaweb\\Nettools\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Uzaweb\\Openexam\\Http\\Controllers\\Admin\\DashboardController' => __DIR__ . '/../..' . '/src/Http/Controllers/Admin/DashboardController.php',
        'Uzaweb\\Openexam\\Http\\Requests\\DashboardRequest' => __DIR__ . '/../..' . '/src/Http/Requests/DashboardRequest.php',
        'Uzaweb\\Openexam\\Models\\Dashboard' => __DIR__ . '/../..' . '/src/Models/Dashboard.php',
        'Uzaweb\\Openexam\\OpenexamServiceProvider' => __DIR__ . '/../..' . '/src/OpenexamServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4d5455324d6a45324d7a55304f413d3d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4d5455324d6a45324d7a55304f413d3d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4d5455324d6a45324d7a55304f413d3d::$classMap;

        }, null, ClassLoader::class);
    }
}
