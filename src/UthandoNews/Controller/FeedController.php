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

use UthandoCommon\Service\ServiceTrait;
use UthandoNews\Options\FeedOptions;
use UthandoNews\Options\NewsOptions;
use UthandoNews\Service\NewsService;
use Zend\Feed\Writer\Feed as ZendFeed;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\FeedModel;


class FeedController extends AbstractActionController
{
    use ServiceTrait;

    public function __construct()
    {
        $this->setServiceName(NewsService::class);
    }

    public function feedAction()
    {
        /* @var \UthandoNews\Options\NewsOptions $options */
        $options = $this->getService(NewsOptions::class);
        /* @var \UthandoNews\Options\FeedOptions $feedOptions */
        $feedOptions = $this->getService(FeedOptions::class);

        $newService = $this->getService();
        $newsItems = $newService->search([
            'sort' => $options->getSortOrder(),
        ]);

        $uri = $this->getRequest()->getUri();
        $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());

        $feed = new ZendFeed();
        $feed->setTitle($feedOptions->getTitle());
        $feed->setFeedLink($base . $this->url()->fromRoute('home'), 'atom');

        $feed->setDescription($feedOptions->getDescription());
        $feed->setLink($base . $this->url()->fromRoute('home'));
        $feed->setDateModified(time());

        /* @var \UthandoNews\Model\NewsModel $item */
        foreach ($newsItems as $item) {
            $entry = $feed->createEntry();
            $entry->addAuthor([
                'name' => $item->getUser()->getFullName(),
            ]);
            $entry->setTitle($item->getTitle());
            $entry->setLink($base . $this->url()->fromRoute('news', [
                    'news-item' => $item->getSlug(),
                ]));
            $entry->setDescription($item->getDescription());
            $entry->setDateModified($item->getDateModified()->getTimestamp());
            $entry->setDateCreated($item->getDateCreated()->getTimestamp());

            $feed->addEntry($entry);
        }

        $feed->export('rss');

        $feedModel = new FeedModel();
        $feedModel->setFeed($feed);

        return $feedModel;
    }
}