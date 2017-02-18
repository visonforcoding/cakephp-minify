<?php
namespace Cakeminify\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Cakeminify\View\Helper\MinifyHelper;

/**
 * Cakeminify\View\Helper\MinifyHelper Test Case
 */
class MinifyHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Cakeminify\View\Helper\MinifyHelper
     */
    public $Minify;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Minify = new MinifyHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Minify);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
