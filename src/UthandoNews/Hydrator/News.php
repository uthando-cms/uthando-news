<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Hydrator
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoCommon\Hydrator\Strategy\DateTime as DateTimeStrategy;
use UthandoNews\Model\News as NewsModel;

/**
 * Class News
 * @package UthandoNews\Hydrator
 */
class News extends AbstractHydrator
{
    public function __construct()
    {
        parent::__construct();

        $dateTime = new DateTimeStrategy();

        //$this->addStrategy('dateCreated', $dateTime);
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
            'articleId'     => $object->getArticleId(),
            'image'         => $object->getImage(),
            'dateModified'  => $this->extractValue('dateModified', $object->getDateModified()),
        ];
    }
}