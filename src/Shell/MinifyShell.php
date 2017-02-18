<?php

namespace Cakeminify\Shell;

use Cake\Console\Shell;
use MatthiasMullie\Minify;

/**
 * Minify shell command.
 */
class MinifyShell extends Shell {

    protected $config;


    public function initialize() {
        parent::initialize();
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() {
        $this->out($this->OptionParser->help());
    }

    public function mincss() {
        $source = \Cake\Core\Configure::read('mincss.source');
        $desc =  \Cake\Core\Configure::read('mincss.desc');
        if(is_array($source)){
            $minifier = new Minify\CSS();
            foreach ($source as $v) {
                $minifier->add($v);
            }
            $minifier->minify($desc);
            $this->out('css 压缩合并完毕');
        }else{
            $this->err('配置不正确');
        }
    }
    
    public function minjs(){
        $source = \Cake\Core\Configure::read('minjs.source');
        $desc =  \Cake\Core\Configure::read('minjs.desc');
        if(is_array($source)){
            $minifier = new Minify\JS();
            foreach ($source as $v) {
                $minifier->add($v);
            }
            $minifier->minify($desc);
            $this->out('js 压缩合并完毕');
        }else{
            $this->err('配置不正确');
        }
    }
    
    protected function createParam($arr){
        $count = count($arr);
        $param = '';
        foreach ($arr as $key => $value) {
            $param .= "'$value'";
            if($key<$count-1){
                $param .=',';
            }
        }
        return $param;
    }

}
