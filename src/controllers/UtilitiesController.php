<?php

/**
 * Functions plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to provide some useful tools
 *
 * @link      http://www.supercooldesign.co.uk/
 * @copyright Copyright (c) 2018 Supercool Ltd
 */

namespace supercool\functions\controllers;

use Craft;
use craft\web\Controller as BaseController;

use supercool\functions\Functions;

class UtilitiesController extends BaseController
{

    public function actionClearCaches()
    {
        Craft::$app->getTemplateCaches()->deleteAllCaches();

        // return result as json
        return $this->asJson(['status' => true]);
    }

}
