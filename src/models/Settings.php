<?php

/**
 * Functions plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to provide some useful tools
 *
 * @link      http://www.supercooldesign.co.uk/
 * @copyright Copyright (c) 2018 Supercool Ltd
 */

namespace supercool\functions\models;

use craft\base\Model;

class Settings extends Model
{
    public $nginxStaticCachePath;

    public function rules()
    {
        return [
            [['nginxStaticCachePath'], 'string'],
        ];
    }
}
