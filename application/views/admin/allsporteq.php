<div class="container">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Разделы</a></li>
            <li><a href="#">Спортивное оборудование</a></li>
        </ol>
        <br/>
    </section>
    <div class="well well-sm">
        <div class="row">
            <div class="pull-right">
                <a href="<?=base_url()?>admin/MainSections/addEq">
                <button class="btn  btn-success ">
                    <i class="fa fa-fw fa-plus"></i>
                    Добавить
                </button>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th>
                №
            </th>
            <th>
                Фото
            </th>
            <th>
                Название
            </th>
            <th>
                Цена
            </th>
            <th colspan="2">
                Редактирование
            </th>
        </tr>
        <?php
        $i=1;
        foreach($sportpits as $row)
        {
            echo '<tr>';
            echo '<td>'.$i++.'</td>';
            echo '<td><img class="photo_user" src="'.site_url().'public/images/equipment/'.$row->imgname.'" alt="">'.'</td>';
            echo '<td>'.$row->eq_name.'</td>';
            echo '<td>'.$row->eq_price.'</td>';
            echo '<td><a href="'.site_url().'admin/MainSections/updateEq/'.$row->id.'"><button type="button" class="btn btn-primary">Редактировать</button></a></td>';
            echo '<td><a href="'.site_url().'admin/MainSections/deleteEq/'.$row->id.'"><button type="button" class="btn btn-danger">Удалить</button></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
        <?php
        echo $this->pagination->create_links();
        ?>


</div>