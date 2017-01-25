<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'Simple ranking system made with CakePHP';
?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $cakeDescription ?>
  </title>
  <?= $this->Html->meta('icon') ?>

  <!-- FontAwesome -->
  <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css') ?>


  <?= $this->Html->css('base.css') ?>
  <?= $this->Html->css('cake.css') ?>

</head>
<body class="home">
  <header>
    <div class="text-center">
      <br>
      <p>You are logged in</p>
      <a id="locacion-submit" href="users" class="button" type="button" name="button"><i class="fa fa-user" aria-hidden="true"></i> Admin users</a>
      <a id="locacion-submit" href="events" class="button" type="button" name="button"><i class="fa fa-table" aria-hidden="true"></i> Admin events</a>
      <a id="locacion-submit" href="events/ranking" class="button" type="button" name="button"><i class="fa fa-star" aria-hidden="true"></i> Go to ranking</a>
      </div>
    </header>

    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'); ?>
    <?= $this->Html->script('reviews.js'); ?>
  </body>
  </html>
