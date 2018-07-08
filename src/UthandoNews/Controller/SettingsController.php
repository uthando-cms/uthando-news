<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNews\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoNews\Controller;

use UthandoCommon\Controller\SettingsTrait;
use UthandoNews\Form\NewsSettingsForm;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class SettingsController
 *
 * @package UthandoNews\Controller
 */
class SettingsController extends AbstractActionController
{
    use SettingsTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFormName(NewsSettingsForm::class)
            ->setConfigKey('uthando_news');
    }
}
