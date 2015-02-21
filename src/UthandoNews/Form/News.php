<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoNews\Form;

use Zend\Form\Form;

/**
 * Class News
 * @package UthandoNews\Form
 */
class News extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'newsId',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'articleId',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'image',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Image',
                'id' => 'news-image',
            ],
            'options' => [
                'label' => 'Image:',
            ],
        ]);

        $this->add([
            'type' => 'UthandoArticleFieldSet',
            'name' => 'article',
            'options' => [
                'label' => 'News Article',
            ],
        ]);
    }
} 