<?php $this->assign('title', 'New Event'); ?>
<?php
$cakeDescription = 'Simple ranking system made with CakePHP';
?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $cakeDescription ?>:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>

  <?= $this->Html->css('base.css') ?>
  <?= $this->Html->css('cake.css') ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>
<body>
  <div class="container-fluid">
    <section class="main">
     <div class="row">
      <div class="col-sm-12">

        <h2>Create Event</h2>

        <?php $this->Form->templates([
         'inputContainer' => '<div class="form-group col-sm-9">{{content}}</div>',
         ]); ?>

         <div class="form-horizontal">
          <?= $this->Form->create($event) ?>
          <fieldset>

            <?php echo $this->Form->input('name' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Event name']); ?>

            <div class="form-group col-sm-9">
              <?php echo $this->Form->input('place' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Event place']) ?>
            </div>

            <div class="select-place">
              <?php echo $this->Form->input('date' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Date (dd/mm/YY/)' ]); ?>
            </div>

            <?php echo $this->Form->input('type' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Event type']); ?>

            <?php echo $this->Form->input('customer' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Customer name']); ?>

            <?php echo $this->Form->input('phone' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Phone']); ?>

            <?php echo $this->Form->input('score' , ['class' => 'form-control' , 'label' => false , 'placeholder'=>'Score']); ?>

          </fieldset>

          <?= $this->Form->button(__('Submit') , ['class' => 'btn btn-primary']) ?>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </section>

  <a id="locacion-submit" href="../events" class="button" type="button" name="button"><i class="fa fa-table" aria-hidden="true"></i> Back to events panel</a>
  <a id="locacion-submit" href="../events/ranking" class="button" type="button" name="button"><i class="fa fa-table" aria-hidden="true"></i> Go to ranking</a>
</div>
<footer>
</footer>
</body>
</html>
