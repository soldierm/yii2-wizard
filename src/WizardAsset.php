<?php

namespace soldierm\wizard;

use yii\web\AssetBundle;

class WizardAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@vendor/soldierm/yii2-wizard/src/assets';

    /**
     * {@inheritdoc}
     */
    public $js = ['js/bootstrap-wizard.min.js'];

    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}