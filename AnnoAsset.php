<?php

namespace ak868308\anno;

/**
 * Asset bundle for [[Anno]] Widget.
 *
 * @author Khalid <ak868308@gmail.com>
 * @since 1.0
 */
class AnnoAsset extends \yii\web\AssetBundle
{
    /**
     * @var array List of bundle class names that this bundle depends on.
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        $this->sourcePath = '@vendor/ak868308/yii2-anno/assets';
        
        $this->css = [
            YII_DEBUG ? 'css/anno.css' : 'css/anno.min.css'
        ];
        
        $this->js = [
            YII_DEBUG ? 'js/anno.js' : 'js/anno.min.js'
        ];
    }
}
