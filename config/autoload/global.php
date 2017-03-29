<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=pagecreator;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);


/*

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'informix:database=backofficedev;host=192.168.51.248;service=118;protocol=onsoctcp;server=ol_dev;client_locale=en_us.utf8;db_locale=en_us.819;',
        'driver_options' => array(

        ),
    ),
    'service_manager' => array(
        'factories' => array(
            // Zend's AdapterServiceFactory
            //'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Core\Db\Adapter\AdapterServiceFactory',
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
*/

//use Core\Db\Adapter\Platform\Sql92;
//$dbParams = array(
//    'username'  => 'baumann',
//    'password'  => 'tonytony',
//);
//
//return array(
//    'service_manager' => array(
//        'factories' => array(
//            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
//                $platform = new Sql92();
//                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
//                    'driver'    => 'Pdo',
//                    'dsn'       => 'informix:database=backofficedev;host=192.168.51.248;service=118;protocol=onsoctcp;server=ol_dev;client_locale=en_us.utf8;db_locale=en_us.819;',
//                    'username'  => $dbParams['username'],
//                    'password'  => $dbParams['password'],
//                ),$platform);
//
//                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler);
//                $adapter->injectProfilingStatementPrototype();
//                return $adapter;
//            },
//            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
//        ),
//    ),
//);