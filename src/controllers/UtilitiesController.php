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
use craft\helpers\FileHelper;

use supercool\functions\Functions;

class UtilitiesController extends BaseController
{

    /**
     * Clear templates caches
     */
    public function actionClearCaches()
    {
        Craft::$app->getTemplateCaches()->deleteAllCaches();

        $plugin = Functions::$plugin;

        // If nginx static cache path config exists clear that folder content
        $nginxStaticCachePath = $plugin->getSettings()->nginxStaticCachePath;
        if ( $nginxStaticCachePath )
        {
            FileHelper::clearDirectory($nginxStaticCachePath);
            Craft::info("FastCGI Cache busted", __METHOD__);
        }

        // Run queues
        Craft::$app->getQueue()->run();

        // return result as json
        return $this->asJson(['status' => true]);
    }


    /**
     * Warm caches using sitemap.xml
     */
    public function actionWarmCaches()
    {
        $sitemap = Craft::$app->getConfig()->general->siteUrl . 'sitemap.xml';

        $sitemap = @simplexml_load_file($sitemap);

        if ( !$sitemap )
        {
            return false;
        }

        $items = json_decode(json_encode($sitemap), TRUE);

        $client = new \GuzzleHttp\Client();

        foreach ($items['url'] as $item) {
            try
            {
                $response = $client->get($item['loc']);
            }
            catch (\Exception $e)
            {
                Craft::info('Could not warm cache for: '.$e->getMessage(), __METHOD__);
            }
        }

        return $this->asJson(['status' => true]);
    }


    /**
     * Clear queues
     */
    public function actionClearQueues()
    {
        Craft::$app->getDb()->createCommand()
            ->truncateTable('{{%queue}}')
            ->execute();

        // return result as json
        return $this->asJson(['status' => true]);
    }

}
