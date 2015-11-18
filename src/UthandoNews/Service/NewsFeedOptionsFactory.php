<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNews\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Service;

use UthandoNews\Options\FeedOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewsFeedOptionsFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return FeedOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator) : FeedOptions
    {
        $config     = $serviceLocator->get('config');
        $config     = $config['uthando_news']['feed'] ?? [];
        $options    = new FeedOptions($config);

        return $options;
    }
}

