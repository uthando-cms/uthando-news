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
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;
use Zend\View\Model\ViewModel;

/**
 * Class News
 *
 * @package UthandoNews\Controller
 * @method \UthandoNews\Service\News getService()
 */
class News extends AbstractCrudController
{
    protected $controllerSearchOverrides = ['sort' => 'newsId'];
    protected $serviceName = 'UthandoNews';
    protected $route = 'admin/news';
    protected $routes = [];

    public function viewAction()
    {
        /* @var \UthandoNews\Options\NewsOptions $options */
        $options = $this->getService('UthandoNewsOptions');

        $this->searchDefaultParams = [
            'sort' => $options->getSortOrder(),
            'count' => $options->getItemsPerPage(),
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

    public function feedAction()
    {
        /* @var \UthandoNews\Options\NewsOptions $options */
        $options = $this->getService('UthandoNewsOptions');
        /* @var \UthandoNews\Options\FeedOptions $feedOptions */
        $feedOptions = $this->getService('UthandoNewsFeedOptions');

        $newService = $this->getService();
        $newsItems = $newService->search([
            'sort' => $options->getSortOrder(),
        ]);

        $uri = $this->getRequest()->getUri();
        $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());

        $feed = new Feed();
        $feed->setTitle($feedOptions->getTitle());
        $feed->setFeedLink($base . $this->url()->fromRoute('home'), 'atom');

        $feed->setDescription($feedOptions->getDescription());
        $feed->setLink($base . $this->url()->fromRoute('home'));
        $feed->setDateModified(time());

        /* @var \UthandoNews\Model\News $item */
        foreach ($newsItems as $item) {
            $entry = $feed->createEntry();
            $entry->addAuthor([
                'name' => $item->getArticle()->getUser()->getFullName(),
            ]);
            $entry->setTitle($item->getArticle()->getTitle());
            $entry->setLink($base . $this->url()->fromRoute('news', [
                'news-item' => $item->getArticle()->getSlug(),
            ]));
            $entry->setDescription($item->getArticle()->getDescription());
            $entry->setDateModified($item->getDateModified()->getTimestamp());
            $entry->setDateCreated($item->getArticle()->getDateCreated()->getTimestamp());

            $feed->addEntry($entry);
        }

        $feed->export('rss');

        $feedModel = new FeedModel();
        $feedModel->setFeed($feed);

        return $feedModel;
    }
} 