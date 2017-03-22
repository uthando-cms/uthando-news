<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoNews\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\Element\Button;
use Zend\Form\Form;

/**
 * Class News
 *
 * @package UthandoNews\Form
 */
class News extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label'     => 'Title',
                'required'  => true,
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Article Title',
            ],
        ]);

        $this->add([
            'name' => 'slug',
            'type' => 'text',
            'options' => [
                'label'       => 'Slug',
                'required'    => false,
                'help-block' => 'If you leave this blank the the title will be used for the slug.',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Slug',
            ],
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'text',
            'options' => [
                'label' => 'Description',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Description',
            ],
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
                'label' => 'Image',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
                'add-on-append' => new Button('news-image-button', [
                    'label' => 'Add Image',
                ]),
            ],
        ]);

        $this->add([
            'name' => 'layout',
            'type' => 'text',
            'options' => [
                'label' => 'Layout',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Layout',
            ],
        ]);

        $this->add([
            'name' => 'lead',
            'type' => 'textarea',
            'options' => [
                'label' => 'Lead Text',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Lead Text',
                'id'          => 'news-lead-textarea',
                'rows'        => 10,
            ],
        ]);

        $this->add([
            'name' => 'content',
            'type' => 'textarea',
            'options' => [
                'label' => 'HTML Content',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
            ],
            'attributes' => [
                'placeholder' => 'HTML Content',
                'class'       => 'editable-textarea',
                'id'          => 'news-content-textarea',
                'rows'        => 25,
            ],
        ]);

        $this->add([
            'name' => 'dateCreated',
            'type' => 'DateTime',
            'options' => [
                'label' => 'Date Created',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
                'format' => 'd/m/Y H:i:s'
            ],
            'attributes' => [
                'disabled' => true,
            ]
        ]);

        $this->add([
            'name' => 'dateModified',
            'type' => 'DateTime',
            'options' => [
                'label' => 'Date Modified',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size' => 'sm-10',
                'label_attributes' => [
                    'class' => 'col-sm-2',
                ],
                'format' => 'd/m/Y H:m:s'
            ],
            'attributes' => [
                'disabled' => true,
            ],
        ]);

        $this->add([
            'name' => 'newsId',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'userId',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'security',
            'type' => 'csrf',
        ]);
    }
} 