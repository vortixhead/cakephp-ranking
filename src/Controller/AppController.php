<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
          // 'authorize' => ['Controller'], // Added this line
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ]
        ]);
    }

    // public function isAuthorized($user)
    // {
    //   Any registered user can access public functions
    //     if (empty($this->request->params['prefix'])) {
    //         return true;
    //     }
    //
    //     $action = $this->request->params['action'];
    // 		//  registered users can add and view index
    // 		if (in_array($action, ['index', 'add'])) {
    // 		return true;
    // 		}
    //
    //
    //     Admin can access every action
    //     if (isset($user['role']) && $user['role'] === 'admin') {
    //         return true;
    //     }
    //
    //     Default deny
    //     return false;
    //
    // }


    public function beforeFilter(Event $event)
   {
     parent::beforeFilter($event);
       // Allow users to register and logout.
       // You should not add the "login" action to allow list. Doing so would
       // cause problems with normal functioning of AuthComponent.
       $this->Auth->allow(['logout']);
   }



    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
