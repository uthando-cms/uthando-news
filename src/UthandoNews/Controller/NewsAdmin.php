<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 2017 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoNews\Controller;

use UthandoCommon\Controller\AbstractCrudController;

/**
 * Class NewsAdmin
 *
 * @package UthandoNews\Controller
 */
class NewsAdmin extends AbstractCrudController
{
    protected $controllerSearchOverrides = ['sort' => 'newsId'];
    protected $serviceName = 'UthandoNews';
    protected $route = 'admin/news';
    protected $routes = [];
}