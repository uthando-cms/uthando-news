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
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class Settings
 *
 * @package UthandoNews\Controller
 */
class Settings extends AbstractActionController
{
    use SettingsTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFormName('UthandoNewsSettings')
            ->setConfigKey('uthando_news');
    }
}
