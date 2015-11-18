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

use UthandoNews\Options\NewsOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewsOptionsFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return NewsOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator) : NewsOptions
    {
        $config     = $serviceLocator->get('config');
        $config     = $config['uthando_news']['options'] ?? [];
        $options    = new NewsOptions($config);

        return $options;
    }
}
