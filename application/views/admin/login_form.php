<div class="col-lg-4 col-lg-offset-4">
    <center>
        <h1>Добро пожаловать!</h1>
        <h3>Пожалуйста, войдите.</h3>
    </center>

    <?php $fattr = array('class' => 'form-signin');
    echo form_open(site_url().'admin/MainAdmin/login', $fattr); ?>
    <div class="form-group">
        <?php echo form_input(array(
            'name'=>'email',
            'id'=> 'email',
            'placeholder'=>'Логин',
            'class'=>'form-control',
            'value'=> set_value('email'))); ?>
        <?php echo form_error('email') ?>
    </div>
    <div class="form-group">
        <?php echo form_password(array(
            'name'=>'password',
            'id'=> 'password',
            'placeholder'=>'Пароль',
            'class'=>'form-control',
            'value'=> set_value('password'))); ?>
        <?php echo form_error('password') ?>
    </div>
        <?php
    echo form_submit(array('value'=>'Войти', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>
