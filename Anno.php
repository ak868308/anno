<?php

/**
 * @copyright Copyright &copy; Khalid Ansari 2018
 * @package yii2-anno
 * @subpackage yii2-anno
 * @version 1.0
 */

namespace ak868308\anno;

use Yii;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Anno lets you add powerful step-by-step guides to your web-apps
 * Anno is built to be extensible. The source is about 500 lines of literate coffeescript; you can read the annotated source in just a few minutes!
 *
 * See Examples: http://iamdanfox.github.io/anno.js/
 * 
 * @author Khalid Ansari <ak868308@gmail.com>
 * @since 1.0
 * @see https://github.com/ak868308/yii2-anno
 * 
 * USAGE: 
 * var anno2 = new Anno([{
 *  target  : 'pre:eq(1)', // second block of code
 *  position: 'top',
 *  content : 'You can specify where you want each anno to appear.'
 * }, {
 *  target  : 'pre:eq(1)',
 *  position: 'left',
 *  content : "Use 'top', 'left', 'bottom' and 'right', just like CSS.",
 * }, {
 *  target  : 'pre:eq(1)',
 *  position: 'center-bottom',
 *  content : "You can also use 'center-bottom', 'center-right' etc"
 * }, {
 *  target  : 'pre:eq(1)',
 *  position: 'right',
 *  className: 'anno-width-200', // 150,175,200,250 (default 300)
 *  content : 'Add CSS classes to customize each annotation.'
 * }, {
 *  target  : 'pre:eq(1)',
 *  position: {
 *    top: '44em',
 *    left: '14em'
 *  },
 *  arrowPosition: 'center-left',
 *  content : 'You can even specify precise <code>top</code> and <code>left</code> values.'
 * }])
 */
class Anno extends \yii\base\Widget {

    const BACK_BUTTON = 'AnnoButton.BackButton';
    const DONE_BUTTON = 'AnnoButton.DoneButton';
    const NEXT_BUTTON = 'AnnoButton.NextButton';
    
    
    /**
     * Return var e.g: anno1
     * @var string 
     */
    public $var;

    /**
     * Plugin Options
     * @var type 
     */
    public $pluginOptions = [];

    /**
     * Either the intro popup should came only for first time load (for new user)
     * @var boolean 
     */
    public $oneTime = FALSE;

    /**
     * An HTML options for widget button
     * @var type 
     */
    public $buttonOptions = [];

    /**
     * Show Intro Button
     * @var boolean 
     */
    public $button = FALSE;

    /**
     * Button label
     * @var string or HTML 
     */
    public $buttonLabel = '?';

    /**
     * Default trigger the plugin on load 
     * @var boolean 
     */
    public $triggerOnLoad = FALSE;

    /**
     * Initializes the pager.
     */
    public function init() {
        parent::init();
        // Register required assets
        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    public function run() {
        parent::run();

        $this->pluginOptions = Json::encode($this->pluginOptions);

        $init_js = "var {$this->var} = new Anno({$this->pluginOptions})";

        //render init js
        $this->view->registerJs($init_js, View::POS_READY, "{$this->var}_anno_main1");

        /**
         * <button type="button" class="btn btn-primary" onclick="anno1.show()">anno1.show()</button>
         * render button
         */
        if ($this->button) {
            $this->buttonOptions['onclick'] = "{$this->var}.show()"; //adding default action
            echo \yii\helpers\Html::button($this->buttonLabel, $this->buttonOptions);
        } elseif ($this->triggerOnLoad) {
            /**
             * setItem() may throw an exception if the storage is full. Particularly, in Mobile Safari (since iOS 5) it always 
             * throws when the user enters private mode (Safari sets quota to 0 bytes in private mode, contrary to other browsers, 
             * who allow storage in private mode, using separate data containers).
             */
            $action_js = "if (!localStorage.getItem('{$this->var}-shown')) {
                try{
                    localStorage.setItem('{$this->var}-shown', {$this->oneTime});
                }catch(ex){
                   console.log(ex);
                }
                {$this->var}.show();
            }";
            $this->view->registerJs($action_js, View::POS_READY, "{$this->var}_anno_main2");
        }

    }

    /**
     * Register required asset bundles.
     *
     */
    protected function registerAssets() {
        AnnoAsset::register($this->view);
    }

}
