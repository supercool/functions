<?php

/**
 * Functions plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to provide some useful tools
 *
 * @link      http://www.supercooldesign.co.uk/
 * @copyright Copyright (c) 2018 Supercool Ltd
 */

namespace supercool\functions;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\services\Utilities;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;

use yii\base\Event;

use supercool\functions\assetbundles\FunctionsAsset;

/**
 * @author    Supercool Ltd
 * @package   Functions
 * @since     1.0.0
 */

class Functions extends Plugin
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register services
        $this->setComponents([
            // 'fetch' => \supercool\fetch\services\Fetch::class,
        ]);

        Event::on(Utilities::class, Utilities::EVENT_REGISTER_UTILITY_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = \supercool\functions\utilities\ClearCaches::class;
            $event->types[] = \supercool\functions\utilities\ClearQueues::class;
        });

        $request = Craft::$app->getRequest();

        // Control panel request
        if ($request->getIsCpRequest() && !$request->getIsConsoleRequest())
        {

            Event::on(Cp::class, Cp::EVENT_REGISTER_CP_NAV_ITEMS, function(RegisterCpNavItemsEvent $event) {
                $event->navItems['functions-zendesk'] = [
                    'label' => \Craft::t('functions', 'Support'),
                    'url' => '#functions-zendesk',
                    'fontIcon' => 'mail'
                ];
            });

            $view = Craft::$app->getView();

            $view->registerAssetBundle(FunctionsAsset::class);
            $view->registerJs('new Functions.Zendesk();');

        }



    }


    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new \supercool\functions\models\Settings();
    }


    /**
     * @return Entries
     */
    // public function getFetch()
    // {
    //     return $this->get('fetch');
    // }

}
