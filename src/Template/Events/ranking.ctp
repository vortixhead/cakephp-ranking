
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


  <?= $this->Html->css('bootstrap.min.css') ?>
  <?= $this->Html->css('base.css') ?>
  <?= $this->Html->css('cake.css') ?>
</head>

<body>
	<div class="container-fluid">
			<section class="main">
				<div class="row">
		

      				<div class="row">
       					<div class="col-sm-12">
							<div class="row">
      							<div class="col-sm-6">

      							</div>
      							<div class="col-sm-2">
									<h2>SCORE</h2>
      							</div>
      							<div class="col-sm-4">

      							</div>
      						</div>
						</div>

            <?php if (isset($score_count)) {?>
            <?php $i_ranked=0; $limit_ranked=5?>
            <?php foreach ($score_count as $k => $v) { ?>
              <div class="col-sm-8">
  							<div class="row">
        							<div class="col-sm-6">
        								<h1><?php echo $i_ranked+1 ?>. <strong><?php echo $v['name']; ?></strong> </h1>
        							</div>
        							<div class="col-sm-2">
  									<h3><?php echo $v['score']; ?></h3>
        							</div>
        							<div class="col-sm-4">
                        <?php
                         for ($i=0;$i<$v['stars'];$i++) {
        								 echo '<i class="fa fa-star"></i>';
                         }
                       ?>
                      </div>
        						</div>
  						</div>
            <?php if (++$i_ranked == $limit_ranked) break; } ?>
            <?php } ?>
      				</div>
      			</div>
			</section>

       <a id="locacion-submit" href="../events" class="button" type="button" name="button"><i class="fa fa-table" aria-hidden="true"></i> Back to events panel</a>


	</div>
	<footer>
	</footer>
</body>



    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'); ?>
    <?= $this->Html->script('reviews.js'); ?>
  </body>
  </html>
