<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Controller;

use UthandoCommon\Controller\AbstractCrudController;

/**
 * Class News
 * @package UthandoNews\Controller
 */
class News extends AbstractCrudController
{
    protected $searchDefaultParams = array('sort' => 'newsId');
    protected $serviceName = 'UthandoNews';
    protected $route = 'admin/news';
    protected $routes = [];

    public function viewAction()
    {
        $viewModel = new ViewModel([
            'models' => $this->getPaginatorResults(),
        ]);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }

        return $viewModel;
    }

    public function newsItem()
    {
        $slug = $this->params()->fromRoute('news');

        $model = $this->getService()->getBySlug($slug);

        return [
            'model' => $model,
        ];
    }
} 