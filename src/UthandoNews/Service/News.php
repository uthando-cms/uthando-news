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

use UthandoCommon\Service\AbstractRelationalMapperService;
use UthandoNews\Model\News as NewsModel;
use Zend\EventManager\Event;
use Zend\Form\Form;

/**
 * Class News
 * @package UthandoNews\Service
 */
class News extends AbstractRelationalMapperService
{
    protected $serviceAlias = 'UthandoNews';

    /**
     * @var array
     */
    protected $referenceMap = [
        'article'  => [
            'refCol'    => 'articleId',
            'service'   => 'UthandoArticle\Service\Article',
        ],
    ];

    /**
     * Attach events
     */
    public function attachEvents()
    {
        $this->getEventManager()->attach([
            'pre.form'
        ], [$this, 'preForm']);

        $this->getEventManager()->attach([
            'pre.save'
        ], [$this, 'preSave']);
    }

    /**
     * @param int $id
     * @param null $col
     * @return array|mixed|\UthandoCommon\Model\ModelInterface
     */
    public function getById($id, $col = null)
    {
        $article = parent::getById($id, $col);
        $this->populate($article, true);

        return $article;
    }

    public function preForm(Event $e)
    {
        $data = $e->getParam('data');
        $data['article']['slug'] = $data['article']['title'];
        $e->setParam('data', $data);
    }

    public function preSave(Event $e)
    {
        $articleService = $this->getService('UthandoArticle\Service\Article');
        $model = $e->getParam('data');
        $article = $model->getArticle();
        $article->setDateModified();
        $result = $articleService->save($article);

        if (!$model->getArticleId()) {
            $model->setArticleId($result);
        }

        $e->setParam('data', $model);
    }

    /**
     * @param $slug
     * @return NewsModel|null
     */
    public function getBySlug($slug)
    {
        $slug = (string) $slug;
        /* @var $mapper \UthandoNews\Mapper\News */
        $mapper = $this->getMapper();
        $model = $mapper->getBySlug($slug);

        if ($model) {
            $this->populate($model, true);
        }

        return $model;
    }
} 