<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdeb224b2975b799397026cbce5d7a3e2
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'SimpleXLSXGen' => __DIR__ . '/..' . '/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitdeb224b2975b799397026cbce5d7a3e2::$classMap;

        }, null, ClassLoader::class);
    }
}