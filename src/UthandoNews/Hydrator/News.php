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
use UthandoCommon\Hydrator\Strategy\DateTime;
use UthandoNews\Model\News as NewsModel;

class News extends AbstractHydrator
{
    public function __construct()
    {
        parent::__construct();

        $dateTime = new DateTime();

        $this->addStrategy('dateCreated', $dateTime);
        $this->addStrategy('dateModified', $dateTime);

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
            'image'         => $object->getImage(),
            'text'          => $object->getText(),
            'dateCreated'   => $this->extractValue('dateCreated', $object->getDateCreated()),
            'dateModified'  => $this->extractValue('dateModified', $object->getDateModified()),
        ];
    }
}