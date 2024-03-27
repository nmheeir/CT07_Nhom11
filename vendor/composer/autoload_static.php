<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2185d2f99bcd56787481d9357a5972d3
{
    public static $files = array (
        'be43101381e4f729bb962d59338ac321' => __DIR__ . '/../..' . '/mvc/inc/send_mail.php',
        '6010b0617deb5493e00140327c393272' => __DIR__ . '/../..' . '/mvc/inc/checkLogin.php',
        '3a037d1e5fcbec7c2f5b5c475c846d0b' => __DIR__ . '/../..' . '/mvc/inc/checkUploadFile.php',
        '59e7e780856baceac5112e806aa0b0d3' => __DIR__ . '/../..' . '/mvc/inc/action_process.php',
    );

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
        'App' => __DIR__ . '/../..' . '/mvc/core/App.php',
        'AuthenciationController' => __DIR__ . '/../..' . '/mvc/controllers/AuthenciationController.php',
        'BaseController' => __DIR__ . '/../..' . '/mvc/controllers/BaseController.php',
        'BaseModel' => __DIR__ . '/../..' . '/mvc/models/BaseModel.php',
        'CompanyModel' => __DIR__ . '/../..' . '/mvc/models/CompanyModel.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'DataView' => __DIR__ . '/../..' . '/mvc/models/DataView.php',
        'Database' => __DIR__ . '/../..' . '/mvc/core/Database.php',
        'OrderController' => __DIR__ . '/../..' . '/mvc/controllers/OrderController.php',
        'OrderModel' => __DIR__ . '/../..' . '/mvc/models/OrderModel.php',
        'RoleModel' => __DIR__ . '/../..' . '/mvc/models/RoleModel.php',
        'UserController' => __DIR__ . '/../..' . '/mvc/controllers/UserController.php',
        'UserModel' => __DIR__ . '/../..' . '/mvc/models/UserModel.php',
        'WelcomeController' => __DIR__ . '/../..' . '/mvc/controllers/WelcomeController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$classMap;

        }, null, ClassLoader::class);
    }
}
