<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc1b1e906dab1d0db6fd07957c6f17409
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
        'd6347f49d0ed6b34916501b61921f090' => __DIR__ . '/../..' . '/app/helpers/constantes.php',
        '0a08994eab3db5ce1c32228553c2ff86' => __DIR__ . '/../..' . '/app/router/router.php',
        'aac4e8ad658e35335fdbde445c9af141' => __DIR__ . '/../..' . '/app/core/controller.php',
        'e0cb52ed9a7e1fcf25ce23ed6adf42b9' => __DIR__ . '/../..' . '/app/database/connect.php',
        'ede913e780455757b47765f8abc31742' => __DIR__ . '/../..' . '/app/database/fetch.php',
        '876b4f22afd77051fbaa53346930541d' => __DIR__ . '/../..' . '/app/database/update.php',
        '5a2cdc651e67fde3bf454f0691d087ab' => __DIR__ . '/../..' . '/app/database/delete.php',
        '7fb61c9f696e1b6a7b86b7af21915305' => __DIR__ . '/../..' . '/app/database/create.php',
        'bfe32b383cba05b8827cb0c507277675' => __DIR__ . '/../..' . '/app/helpers/redirect.php',
        'd46f1b7e3c000b43adb472675d92cfea' => __DIR__ . '/../..' . '/app/helpers/flash.php',
        '94ef2eea8d34bc053c39afffe2688270' => __DIR__ . '/../..' . '/app/helpers/session.php',
        '6a36059229e5b0ea87a5793c5a8f4d95' => __DIR__ . '/../..' . '/app/helpers/validate.php',
        '867c8dc2ed5591d2601445bc90d7d7ca' => __DIR__ . '/../..' . '/app/helpers/validations.php',
        '32ea7c45141d8683b996d79d4506fe3d' => __DIR__ . '/../..' . '/app/helpers/helpers.php',
        '879df3bf8033cab604e7206bebfa73f1' => __DIR__ . '/../..' . '/app/helpers/old.php',
        'd5470fb3a0a5e407d96a2eb8794d5037' => __DIR__ . '/../..' . '/app/helpers/csrf.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'P' => 
        array (
            'PhpOption\\' => 10,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'G' => 
        array (
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
            'Doctrine\\Inflector\\' => 19,
        ),
        'A' => 
        array (
            'Aritana\\EstruturaPhp\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'Doctrine\\Inflector\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/inflector/lib/Doctrine/Inflector',
        ),
        'Aritana\\EstruturaPhp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc1b1e906dab1d0db6fd07957c6f17409::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc1b1e906dab1d0db6fd07957c6f17409::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc1b1e906dab1d0db6fd07957c6f17409::$classMap;

        }, null, ClassLoader::class);
    }
}
