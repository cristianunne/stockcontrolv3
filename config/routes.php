<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Index', 'action' => 'index']);


        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    $routes->connect(
        '/API/index',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'index']
    );

    $routes->connect(
        '/API/loginApp',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'loginApp']
    );

    $routes->connect(
        '/API/getCompras',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getCompras']
    );

    $routes->connect(
        '/API/setCompras',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'setCompras']
    );

    $routes->connect(
        '/API/addVenta',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'addVenta']
    );

     $routes->connect(
         '/API/getCampaignUser',
         ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getCampaignUser']
     );

    $routes->connect(
        '/API/getProductos',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getProductos']
    );

    $routes->connect(
        '/API/getCategories',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getCategories']
    );

    $routes->connect(
        '/API/getSubcategories',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getSubcategories']
    );

    $routes->connect(
        '/API/getProveedores',
        ['prefix' => 'API', 'controller' => 'Api', 'action' => 'getProveedores']
    );

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
