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
use UthandoNews\Options\NewsOptions;
use UthandoTwitter\Form\SocialMediaFieldSet;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element\Number;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\I18n\Validator\IsInt;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class NewsOptionsFieldSet extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods())
            ->setObject(new NewsOptions());
    }

    public function init()
    {
        $this->add([
            'name' => 'title_case',
            'type' => Select::class,
            'options' => [
                'label' => 'Title Formating',
                'column-size' => 'md-8',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
                'value_options' => [
                    NewsOptions::TITLE_CASE_NONE    => 'No Formatting',
                    NewsOptions::TITLE_CASE_LOWER   => 'lowercase all characters',
                    NewsOptions::TITLE_CASE_UPPER   => 'UPPERCASE ALL CHARACTERS',
                    NewsOptions::TITLE_CASE_FIRST   => 'Uppercase first character only',
                    NewsOptions::TITLE_CASE_WORDS   => 'Uppercase First Character Of Each Word',
                ],
            ],
        ]);

        $this->add([
            'name' => 'sort_order',
            'type' => Text::class,
            'options' => [
                'label' => 'Sort Order',
                'column-size' => 'md-8',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ]);

        $this->add([
            'name' => 'items_per_page',
            'type' => Number::class,
            'options' => [
                'label' => 'NewsForm Items Per Page',
                'column-size' => 'md-8',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
                'label_attributes' => [
                    'class' => 'col-md-4',
                ],
            ],
        ]);

        $this->add([
            'type' => SocialMediaFieldSet::class,
            'name' => 'auto_post',
            'options' => [
                'label' => 'Auto Post To:',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-12',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title_case' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
            ],
            'sort_order' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 255,
                    ]],
                ],
            ],
            'items_per_page' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                    ['name' => ToInt::class],
                ],
                'validators' => [
                    ['name' => IsInt::class],
                ],
            ],
        ];
    }
}
