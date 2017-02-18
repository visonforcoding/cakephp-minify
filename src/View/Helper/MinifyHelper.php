<?php

namespace Cakeminify\View\Helper;

use Cake\View\Helper;
use Cake\View\View;


/**
 * Minify helper
 * @property Helper\HtmlHelper $Html Description
 */
class MinifyHelper extends Helper {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $helpers = ['Html'];

    public function generateAsset() {
        $debug = \Cake\Core\Configure::read('debug');
        $css_source = \Cake\Core\Configure::read('mincss.source');
        $js_source = \Cake\Core\Configure::read('minjs.source');
        $css_desc = \Cake\Core\Configure::read('mincss.desc');
        $js_desc = \Cake\Core\Configure::read('minjs.desc');
        $output = '';
        if ($debug) {
            $output .= $this->Html->css($css_source);
            $output .= $this->Html->script($js_source);
        }else{
            $output .= $this->Html->css($css_desc);
            $output .= $this->Html->script($js_desc);
        }
        return $output;
    }

}
