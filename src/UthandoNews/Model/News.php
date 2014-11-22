<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Model
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Model;

use UthandoCommon\Model\DateCreatedTrait;
use UthandoCommon\Model\DateModifiedTrait;
use UthandoCommon\Model\Model;
use UthandoCommon\Model\ModelInterface;
use UthandoUser\Model\UserIdTrait;

/**
 * Class News
 * @package UthandoNews\Model
 */
class News implements ModelInterface
{
    use Model,
        UserIdTrait,
        DateCreatedTrait,
        DateModifiedTrait;

    /**
     * @var int
     */
    protected $newsId;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var string
     */
    protected $text;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * @param int $newsId
     * @return $this
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
} 