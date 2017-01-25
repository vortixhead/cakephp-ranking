<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Ingresa E-mail y contraseña') ?></legend>
        <?= $this->Form->input('username', [
            'label' => 'Correo electrónico'
        ]) ?>
        <?= $this->Form->input('password', [
            'label' => 'Contraseña'
        ]) ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
