<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

/**
 * Class News
 *
 * @package UthandoNews\Controller
 */
class News extends AbstractCrudController
{
    protected $controllerSearchOverrides = ['sort' => 'newsId'];
    protected $serviceName = 'UthandoNews';
    protected $route = 'admin/news';
    protected $routes = [];

    public function viewAction()
    {
        $this->searchDefaultParams = [
            'sort' => '-dateCreated',
            'count' => 5,
            'page' => $this->params()->fromRoute('page'),
        ];
        
        $viewModel = new ViewModel([
            'models' => $this->getPaginatorResults(false),
        ]);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }

        return $viewModel;
    }

    public function newsItemAction()
    {
        $slug = $this->params()->fromRoute('news-item');

        $model = $this->getService()->getBySlug($slug);

        return [
            'model' => $model,
        ];
    }
} 