<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNews\Options
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class NewsOptions
 *
 * @package UthandoNews\Options
 */
class NewsOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $sortOrder;

    /**
     * @var int
     */
    protected $itemsPerPage;

    /**
     * @var array
     */
    protected $autoPost = [];

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param string $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }

    /**
     * @return array
     */
    public function getAutoPost(): array
    {
        return $this->autoPost;
    }

    /**
     * @param array $autoPost
     * @return BlogOptions
     */
    public function setAutoPost(array $autoPost): NewsOptions
    {
        foreach ($autoPost as $key => $value) {
            if ('0' === $value) unset($autoPost[$key]);
        }
        $this->autoPost = $autoPost;
        return $this;
    }
}
