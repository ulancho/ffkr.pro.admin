
<div class="col-lg-4 col-lg-offset-4">
            <strong><center>СПОРТИВНОЕ ПИТАНИЕ</center></strong>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
    <span class="fa fa-"></span>
    <?php
        $fattr = array('class' => 'form-signin');
        echo form_open_multipart('/MainSections/addSportpit', $fattr);
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
    <?php
        $dd_list = array(
                  '1'   => 'Протеин',
                  '2'   => 'Витамины',
                );
        $dd_name = "section";
        echo form_dropdown($dd_name, $dd_list, set_value($dd_name),'class = "form-control" id="section"');
    ?>
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