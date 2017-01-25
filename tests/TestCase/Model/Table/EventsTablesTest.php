<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTables;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTables Test Case
 */
class EventsTablesTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTables
     */
    public $EventsTables;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Eventss') ? [] : ['className' => 'App\Model\Table\EventsTables'];
        $this->EventsTables = TableRegistry::get('Eventss', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventsTables);

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
