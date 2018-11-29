<!--Modal trainers-->
<div id="myModal9" class="modal" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content tr-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
                <p>Содержимое окна</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!--/.Modal trainers-->


<!-- The Modal  Форма обратной связи -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Форма обратной связи</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="suc_img" style="display:none;margin: 0 auto">
                    <img src="<?=base_url()?>public/images/ok.png" style="">
                </div>

                <div class="modals-content">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Тел:">
                    </div>
                    <input type="submit" class="btn btn-default addZayavka" value="Отправить">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
</div>
<!-- /.The Modal -->