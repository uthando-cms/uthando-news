<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Hydrator
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoCommon\Hydrator\Strategy\DateTime as DateTimeStrategy;
use UthandoNews\Model\NewsModel as NewsModel;

/**
 * Class NewsForm
 *
 * @package UthandoNews\Hydrator
 */
class NewsHydrator extends AbstractHydrator
{
    public function __construct()
    {
        parent::__construct();

        $dateTime = new DateTimeStrategy();

        $this->addStrategy('dateCreated', $dateTime);
        $this->addStrategy('dateModified', $dateTime);

        return $this;
    }

    /**
     * Extract values from an object
     *
     * @param NewsModel $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'newsId'        => $object->getNewsId(),
            'userId'        => $object->getUserId(),
            'title'         => $object->getTitle(),
            'slug'          => $object->getSlug(),
            'content'       => $object->getContent(),
            'description'   => $object->getDescription(),
            'pageHits'      => $object->getPageHits(),
            'image'         => $object->getImage(),
            'layout'        => $object->getLayout(),
            'lead'          => $object->getLead(),
            'dateCreated'   => $this->extractValue('dateCreated', $object->getDateCreated()),
            'dateModified'  => $this->extractValue('dateModified', $object->getDateModified()),
        ];
    }
}