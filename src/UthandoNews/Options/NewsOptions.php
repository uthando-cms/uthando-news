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

use UthandoCommon\Filter\UcFirst;
use UthandoCommon\Filter\Ucwords;
use Zend\Filter\StringToLower;
use Zend\Filter\StringToUpper;
use Zend\Stdlib\AbstractOptions;

/**
 * Class NewsOptions
 *
 * @package UthandoNews\Options
 */
class NewsOptions extends AbstractOptions
{
    const TITLE_CASE_NONE   = 'none';
    const TITLE_CASE_LOWER  = StringToLower::class;
    const TITLE_CASE_UPPER  = StringToUpper::class;
    const TITLE_CASE_FIRST  = UcFirst::class;
    const TITLE_CASE_WORDS  = Ucwords::class;

    /**
     * @var string
     */
    protected $titleCase = Ucwords::class;

    /**
     * @var string
     */
    protected $sortOrder = '-dateCreated';

    /**
     * @var int
     */
    protected $itemsPerPage = 10;

    /**
     * @var array
     */
    protected $autoPost = [];

    /**
     * @return string
     */
    public function getTitleCase(): string
    {
        return $this->titleCase;
    }

    /**
     * @param string $titleCase
     * @return NewsOptions
     */
    public function setTitleCase(string $titleCase): NewsOptions
    {
        $this->titleCase = $titleCase;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    /**
     * @param string $sortOrder
     * @return NewsOptions
     */
    public function setSortOrder(string $sortOrder): NewsOptions
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return NewsOptions
     */
    public function setItemsPerPage(int $itemsPerPage): NewsOptions
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
     * @return NewsOptions
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
