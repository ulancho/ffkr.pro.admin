<nav class="navbar navbar-inverse">
            <div class="container">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo site_url();?>mainAdmin/admin">Федерация Фитнеса</a>
                </div>
            
                <!-- ссылки итд -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url();?>main/"><i class="fas fa-tachometer" aria-hidden="true"></i>Главная</a></li>

                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-puzzle-piece" aria-hidden="true"></i>Разделы<span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url();?>MainSections/sportpit">Спортивное питание</a></li>
<!--                                <li><a href="--><?php //echo site_url();?><!--main/adduser">Добавление пользоавтелей</a></li>-->
<!--                                <li><a href="--><?php //echo site_url();?><!--'main/banuser">Бан пользователей</a></li>-->
<!--                                <li><a href="--><?php //echo site_url();?><!--main/changelevel">Роли</a></li>-->
<!--                                <li><a href="--><?php //echo site_url();?><!--for_admin_time/index">Пользователи и время</a></li>-->
                              </ul>
                            </li>

                  </ul>

                  <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>  <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url().'mainAdmin/logout' ?>">Выйти</a></li>
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </div>
        </nav>
