<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Mapper
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;
use UthandoNews\Model\News as NewsModel;

/**
 * Class News
 * @package UthandoNews\Mapper
 */
class News extends AbstractDbMapper
{
    protected $table = 'news';
    protected $primary = 'newsId';

    /**
     * @param $slug
     * @return null|NewsModel
     */
    public function getBySlug($slug)
    {
        $select = $this->getSelect();
        $select->where(['slug' => $slug]);

        $rowSet = $this->fetchResult($select);
        $row = $rowSet->current();

        return $row;
    }
} 