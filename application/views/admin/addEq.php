
<div class="col-lg-4 col-lg-offset-4">
        <strong><center>СПОРТИВНОЕ ОБОРУДОВАНИЕ</center></strong>
    <a href="<?=base_url()?>admin/MainSections/allsporteq" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
    <span class="fa fa-"></span>
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart('admin/MainSections/addEq', $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.Не больше 60 символов </label>
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => set_value('firstname'))); ?>
        <?php echo form_error('name');?>
    </div>
    <div class="form-group">
        <label for="">Введите цену.</label>
        <?php echo form_input(array('name'=>'price', 'id'=> 'price', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
        <?php echo form_error('price');?>
    </div>
    <div class="form-group">
        <label for="">Введите информацию.Не больше 220 символов.</label>
        <?php echo form_textarea(array('name'=>'text', 'id'=> 'text', 'placeholder'=>'Информация', 'class'=>'form-control', 'value'=> set_value('email'))); ?>
        <?php echo form_error('text');?>
    </div>
    <div class="form-group">
        <label for="">Введите номер телефона.Только цифры.</label>
        <?php echo form_input(array('name'=>'number_phone', 'id'=> 'text', 'placeholder'=>'Тел. номер', 'class'=>'form-control', 'value'=> set_value('number_phone'))); ?>
        <?php echo form_error('number_phone');?>
    </div>

    <div class="form-group">
        <label for="photo">Фото:</label>
        <input id="photo" name="photo" type="file" class="form-control" accept="image/*" >
        <div class="alert alert-danger">
            <?php echo $imgerror;?>
        </div>
    </div>
    <?php echo form_submit(array('value'=>'Добавить', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>