<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNews\Event
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Event;

use UthandoNavigation\Service\MenuService;
use UthandoNavigation\Service\SiteMapService;
use UthandoNews\Service\NewsService;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

/**
 * Class SiteMapListener
 *
 * @package UthandoNews\Event
 */
class SiteMapListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();

        $this->listeners[] = $events->attach([
            SiteMapService::class,
        ], ['uthando.site-map'], [$this, 'addPages']);
    }

    public function addPages(Event $e)
    {
        /* @var \Zend\Navigation\Navigation $navigation */
        $navigation = $e->getParam('navigation');

        /* @var NewsService $newsService */
        $newsService = $e->getTarget()->getService(NewsService::class);

        /* @var MenuService $menuService */
        $menuService = $e->getTarget()->getService(MenuService::class);

        $newsItems = $newsService->search([
            'sort' => '-dateCreated',
        ]);

        $pages = [];

        /* @var \UthandoNews\Model\NewsModel $newsItem */
        foreach ($newsItems as $newsItem) {
            $pages[$newsItem->getSlug()] = [
                'label'     => $newsItem->getTitle(),
                'route'     => 'news',
                'params'    => [
                    'news-item' => $newsItem->getSlug(),
                ],
            ];
        }

        // find shop page
        $newsPage = $navigation->findOneByRoute('news-list');

        // add categories to shop page
        $newsPage->addPages($menuService->preparePages($pages));

    }
}
