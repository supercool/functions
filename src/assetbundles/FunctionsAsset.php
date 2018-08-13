<?php

/**
 * Functions plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to provide some useful tools
 *
 * @link      http://www.supercooldesign.co.uk/
 * @copyright Copyright (c) 2018 Supercool Ltd
 */

namespace supercool\functions\assetbundles;

use Craft;
use craft\web\View;
use craft\helpers\Json;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class FunctionsAsset extends AssetBundle
{

  // Public Methods
  // =========================================================================

  /**
   * Initializes the bundle.
   */
  public function init()
  {
      // define the path that your publishable resources live
    $this->sourcePath = "@supercool/functions/assetbundles/dist";

    // define the dependencies
    $this->depends = [
      CpAsset::class,
    ];

    // define the relative path to CSS/JS files that should be registered with the page
    // when this asset bundle is registered
    $this->js = [
      'js/functions.js',
    ];

    $this->css = [
      'css/functions.css',
    ];

    parent::init();
  }

}
