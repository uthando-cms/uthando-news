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

use UthandoCommon\Service\ServiceTrait;
use UthandoNews\Options\NewsOptions;
use UthandoNews\Service\News;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class NewsForm
 *
 * @package UthandoNews\Controller
 * @method \UthandoNews\Service\News getService()
 */
class NewsController extends AbstractActionController
{
    use ServiceTrait;

    public function __construct()
    {
        $this->setServiceName(News::class);
    }

    public function viewAction()
    {
        /* @var \UthandoNews\Options\NewsOptions $options */
        $options = $this->getService(NewsOptions::class);
        $search = $this->params()->fromPost('search', null);

        $params = [
            'sort'  => $options->getSortOrder(),
            'count' => $options->getItemsPerPage(),
            'page'  => $this->params()->fromRoute('page'),
            'title-description' => $search,
            //'tag'   => $this->params()->fromRoute('tag'),
        ];

        $service = $this->getService();

        $service->usePaginator([
            'limit' => $params['count'],
            'page' => $params['page'],
        ]);

        $viewModel = new ViewModel([
            'models'    => $service->search($params),
            'view'      => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
        ]);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }

        return $viewModel;
    }

    public function newsItemAction()
    {
        $slug = $this->params()->fromRoute('news-item', null);

        if (null === $slug) {
            return $this->redirect()->toRoute('news-list');
        }

        $viewModel  = new ViewModel();
        $model      = $this->getService()->getBySlug($slug);

        if (!$model) {
            $viewModel->setTemplate('uthando-news/news/404');
            return $viewModel;
        } else {
            $layout = ($model->getLayout()) ?: 'uthando-news/news/news-item';
            $viewModel->setTemplate($layout);
        }

        $this->getService()->addPageHit($model);

        return $viewModel->setVariables(['model' => $model]);

    }
} 