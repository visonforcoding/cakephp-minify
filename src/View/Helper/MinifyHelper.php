<?php

namespace Cakeminify\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use MatthiasMullie\Minify;

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

    public function generateAsset($config = null) {
        $debug = \Cake\Core\Configure::read('debug');
        $css_source = \Cake\Core\Configure::read('mincss.source');
        $js_source = \Cake\Core\Configure::read('minjs.source');
        $css_desc = \Cake\Core\Configure::read('mincss.desc');
        $js_desc = \Cake\Core\Configure::read('minjs.desc');
        $output = '';
        if ($debug) {
            $output .= $this->Html->css($css_source);
            $output .= $this->Html->script($js_source);
        } else {
            $output .= $this->Html->css($css_desc);
            $output .= $this->Html->script($js_desc);
        }
        return $output;
    }

    /**
     * 输出css
     * @param array $css
     * @param string $output
     * @param bool $minify 是否压缩
     */
    public function outputCss($css, $output, $minify = true) {
        $debug = \Cake\Core\Configure::read('debug');
        if ($debug) {
            return $this->Html->css($css);
        }
        if (file_exists(WWW_ROOT . substr($output, 1))) {
            return $this->Html->css($output);
        }
        if (!$minify) {
            foreach ($css as $v) {
                file_put_contents(WWW_ROOT . substr($output, 1), file_get_contents(WWW_ROOT . substr($v, 1)), FILE_APPEND);
            }
            return $this->Html->css($output);
        }
        $minifier = new Minify\CSS();
        foreach ($css as $v) {
            $minifier->add(WWW_ROOT . substr($v, 1));
        }
        $minifier->minify(WWW_ROOT . substr($output, 1));
        return $this->Html->css($output);
    }

    /**
     * 输出js
     * @param array $js
     * @param string $output
     * @param bool $minify Description
     * @return type
     */
    public function outputJs($js, $output, $minify = true) {
        $debug = \Cake\Core\Configure::read('debug');
        if ($debug) {
            return $this->Html->script($js);
        }
        if (file_exists(WWW_ROOT . substr($output, 1))) {
            return $this->Html->script($output);
        }
        if (!$minify) {
            foreach ($js as $v) {
                file_put_contents(WWW_ROOT . substr($output, 1), file_get_contents(WWW_ROOT . substr($v, 1)), FILE_APPEND);
            }
            return $this->Html->script($output);
        }

        $minifier = new Minify\JS();
        foreach ($js as $v) {
            $minifier->add(WWW_ROOT . substr($v, 1));
        }
        $minifier->minify(WWW_ROOT . substr($output, 1));
        return $this->Html->script($output);
    }

}
