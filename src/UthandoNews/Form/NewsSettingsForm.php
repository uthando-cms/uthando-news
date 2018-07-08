<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNews\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\Form;

/**
 * Class NewsSettingsForm
 *
 * @package UthandoNews\Form
 */
class NewsSettingsForm extends Form
{
    public function init()
    {
        $this->add([
            'type' => NewsOptionsFieldSet::class,
            'name' => 'options',
            'options' => [
                'label' => 'News Settings',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-6',
            ],
        ]);

        $this->add([
            'type' => NewsFeedFieldSet::class,
            'name' => 'feed',
            'options' => [
                'label' => 'News Feed',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-6',
            ],
        ]);
    }
}
