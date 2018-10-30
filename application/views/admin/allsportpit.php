<div class="container">
    <p class="text-primary">Спортивное питание</p>
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
            echo '<td><img class="photo_user" src="'.site_url().'public/images/sportpit/'.$row->sp_imgname.'" alt="">'.'</td>';
            echo '<td>'.$row->sp_name.'</td>';
            echo '<td>'.$row->sp_price.'</td>';
            echo '<td><a href="'.site_url().'main/changelevel"><button type="button" class="btn btn-primary">Редактировать</button></a></td>';
            echo '<td><a href="'.site_url().'MainSections/deletesportpit/'.$row->id.'"><button type="button" class="btn btn-danger">Удалить</button></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
        <?php
        echo $this->pagination->create_links();
        ?>


</div>