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

use yii\base\Event;

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
        });

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
