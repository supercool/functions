<?php

/**
 * Functions plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to provide some useful tools
 *
 * @link      http://www.supercooldesign.co.uk/
 * @copyright Copyright (c) 2018 Supercool Ltd
 */

namespace supercool\functions\utilities;

use Craft;
use craft\base\Utility;

use supercool\functions\assetbundles\FunctionsAsset;

class ClearQueues extends Utility
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('functions', 'Queues');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'sc-clear-queues';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias('@app/icons/clock.svg');
    }

    /**
     * @inheritdoc
     */
    public static function contentHtml(): string
    {
        $view = Craft::$app->getView();

        $view->registerAssetBundle(FunctionsAsset::class);
        $view->registerJs('new Functions.ClearQueuesUtility(\'sc-clear-queues\');');

        return $view->renderTemplate('functions/utilities/_clear-queues');
    }
}
