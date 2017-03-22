<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Service;

use UthandoCommon\Service\AbstractRelationalMapperService;
use UthandoNews\Model\News as NewsModel;
use Zend\EventManager\Event;

/**
 * Class News
 *
 * @package UthandoNews\Service
 */
class News extends AbstractRelationalMapperService
{
    protected $serviceAlias = 'UthandoNews';

    /**
     * @var array
     */
    protected $referenceMap = [
        'user' => [
            'refCol' => 'userId',
            'service' => 'UthandoUser',
        ],
    ];

    /**
     * Attach events
     */
    public function attachEvents()
    {
        $this->getEventManager()->attach([
            'form.init'
        ], [$this, 'setSlug']);

        $this->getEventManager()->attach([
            'pre.add', 'pre.edit'
        ], [$this, 'setValidation']);
    }

    /**
     * @param Event $e
     */
    public function setSlug(Event $e)
    {
        $data = $e->getParam('data');

        if (null === $data) {
            return;
        }

        if ($data instanceof NewsModel) {
            $data->setSlug($data->getTitle());
        } elseif (is_array($data)) {
            $data['slug'] = $data['slug'];
        }

        $e->setParam('data', $data);
    }

    /**
     * @param Event $e
     */
    public function setValidation(Event $e)
    {
        $form = $e->getParam('form');
        $model = $e->getParam('model');
        $post = $e->getParam('post');

        if ($model instanceof NewsModel) {
            $model->setDateModified();
        }

        $form->setValidationGroup([
            'newsId', 'userId', 'title', 'slug',
            'content', 'description',
            'image', 'lead', 'layout',
        ]);
    }

    /**
     * @param int $id
     * @param null $col
     * @return array|mixed|\UthandoCommon\Model\ModelInterface
     */
    public function getById($id, $col = null)
    {
        $model = parent::getById($id, $col);
        $this->populate($model, true);

        return $model;
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

    /**
     * @param NewsModel $newsModel
     */
    public function addPageHit(NewsModel $newsModel)
    {
        $pageHits = $newsModel->getPageHits();
        $pageHits++;
        $newsModel->setPageHits($pageHits);
        $this->save($newsModel);
    }
} 