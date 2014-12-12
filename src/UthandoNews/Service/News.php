<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Service;

use UthandoCommon\Service\AbstractMapperService;
use UthandoNews\Model\News as NewsModel;

/**
 * Class News
 * @package UthandoNews\Service
 */
class News extends AbstractMapperService
{
    protected $serviceAlias = 'UthandoNews';

    /**
     * @param $slug
     * @return NewsModel|null
     */
    public function getBySlug($slug)
    {
        $slug = (string) $slug;
        /* @var $mapper \UthandoNews\Mapper\News */
        $mapper = $this->getMapper();
        return $mapper->getBusinessBySlug($slug);
    }
} 