<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', 'b5bd2e939603411f45710261ab4fa95a37faa23b807216671a34bf1b67ad0ae7'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'port' => '3306',
            'username' => 'root',
            'password' => 'Mysql1234_@',
            'database' => 'stock_control',
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'url' => env('DATABASE_URL', null),
        ],

    /*'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => '156.67.73.151',
            'port' => '3306',
            'username' => 'u805137499_simm',
            'password' => '2XPZ88Qwy$A$vr#',
            'database' => 'u805137499_simm',
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'url' => env('DATABASE_URL', null),
        ],*/


        /*
         * The test connection is used during the test suite.
         */
        /*'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tests.sqlite'),
        ],*/
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];
