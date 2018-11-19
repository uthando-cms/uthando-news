<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 2017 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoNews\View;

use UthandoCommon\Service\ServiceManager;
use UthandoCommon\View\AbstractViewHelper;
use UthandoNews\Model\NewsModel as NewsModel;
use UthandoNews\Service\NewsService as NewsService;

/**
 * Class RecentNews
 *
 * @package UthandoNews\View
 */
class NewsHelper extends AbstractViewHelper
{
    /**
     * @var NewsService
     */
    protected $service;

    /**
     * @return NewsHelper
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
    public function getPopular()
    {
        return $this->getService()
            ->getPopularNews(5);
    }

    /**
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
    public function getRecent()
    {
        return $this->getService()
            ->getRecentNews(5);
    }

    /**
     * @param $id
     * @return NewsModel|null
     */
    public function getPrevious($id)
    {
        $prev = $this->getService()->getMapper()
            ->getPrevious($id);

        return $prev;
    }

    /**
     * @param $id
     * @return NewsModel|null
     */
    public function getNext($id)
    {

        $next = $this->getService()->getMapper()
            ->getNext($id);

        return $next;
    }

    /**
     * @return NewsService
     */
    public function getService()
    {
        if (!$this->service instanceof NewsService) {

            $service = $this->getServiceLocator()
                ->getServiceLocator()
                ->get(ServiceManager::class)
                ->get(NewsService::class);
            $this->setService($service);
        }

        return $this->service;
    }

    /**
     * @param NewsService $service
     * @return NewsHelper
     */
    public function setService(NewsService $service)
    {
        $this->service = $service;
        return $this;
    }
}