<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    // public function isAuthorized($user)
    // {
    //     // All registered users can add events
    //     if ($this->request->action === 'add') {
    //         return true;
    //     }
    //
    //     // The owner of an event can edit and delete it
    //     if (in_array($this->request->action, ['edit', 'delete'])) {
    //         $eventId = (int)$this->request->params['pass'][0];
    //         if ($this->Events->isOwnedBy($eventId, $user['id'])) {
    //             return true;
    //         }
    //     }
    //
    //     // return false;
    //
    //     return parent::isAuthorized($user);
    // }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function export(){
      $this->response->download("export.csv");

      $events = TableRegistry::get('Events');
      $places = $events->find('all');

      $results = $places->all();
      $data = $results->toArray();

      $this->set('data',$data);

      $this->viewBuilder()->layout('ajax');

      return;
    }


    public function ranking()
    {
      $now_complete = new \DateTime();
      $now = new \DateTime('today midnight');
      $now_ymd = $now->format("Y-m-d");
      $now_h = $now_complete->format("H");
      $today_7am=$now->modify('+7 hours');
      $yesterday_7am=$today_7am->modify('-1 day');

      $events = TableRegistry::get('Events');
      $places = $events->find();
      $places->order(['score' => 'DESC']);

      $results = $places->all();
      $data = $results->toArray();
      // Calculate score
      $score_count = array();


      foreach ($data as $key => $value) {
        $date = $data[$key]['created'];
        $data[$key]['date_raw'] = $date;
        $formato = 'Y-m-d';
        $oDate = $date->format($formato);
        $hDate = $date->format('H');
        // Between 00h and 7h
        if(($now_h<7)&&($now_h>0)){
          if($oDate==$now_ymd){
            if(($hDate<=7)){
              if(!array_key_exists($value->phone,$score_count)){
                $score_count[$value->phone]=array("phone"=>$value->phone,"score"=>$value->score,"name"=>$value->name, "stars"=> 1, "date"=>$date, 'time'=>$now_h , 'message'=>'Today before 7AM');
              }else{
                $score_count[$value->phone]['score']+=$value->score;
              }
            }
          }
          // Y los de ayer despues de las 7am
          if($oDate<$now_ymd){
            if($date>$yesterday_7am){
              if(!array_key_exists($value->phone,$score_count)){
                $score_count[$value->phone]=array("phone"=>$value->phone,"score"=>$value->score,"name"=>$value->name, "stars"=> 1, "date"=>$date, 'time'=>$now_h , 'message'=>'Yesterday after 7AM');
              }else{
                $score_count[$value->phone]['score']+=$value->score;
              }
            }
          }
        }else {//Between 7h and 24h
          if($oDate==$now_ymd){
            if($hDate>7){
              if(!array_key_exists($value->phone,$score_count)){
                $score_count[$value->phone]=array("phone"=>$value->phone,"score"=>$value->score,"name"=>$value->name, "stars"=> 1, "date"=>$date, 'time'=>$now_h , 'message'=>'Today after 7AM');
              }else{
                $score_count[$value->phone]['score']+=$value->score;
              }
            }
          }
        }



      }

      function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
          $sort_col = array();
          foreach ($arr as $key=> $row) {
              $sort_col[$key] = $row[$col];
          }

          array_multisort($sort_col, $dir, $arr);
      }

      // Ordenar elementos del ranking de mayor a menor
      array_sort_by_column($score_count, 'score');


      // Calcular cuantos vasos salen con regla de tres
      $top_ranked = $score_count[0]["score"];
      $i_ranking_stars = 0;
      foreach ($score_count as $box) {
        $v1 = $top_ranked;
        $limit=5;
        $v2 = $box['score'];
        $score_count[$i_ranking_stars]["stars"] = ceil(($limit*$v2)/$v1);
        $i_ranking_stars++;
      }

      $this->set('data',$data);
      $this->set('score_count',$score_count);

    }


    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            $event->user_id = $this->Auth->user('id');
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'ranking']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
        $this->viewBuilder()->layout(false);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
