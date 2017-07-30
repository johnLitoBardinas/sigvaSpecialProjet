<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
           </button>
            <a class="navbar-brand" href="<?= site_url('teacher/home') ?>"><span class="fa fa-university"></span>Teacher's Panel</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active"><a href="<?= site_url('teacher/home') ?>"><i class="fa fa-bullseye"></i> Home </a></li>
                <li id="sched"><a href="#"><i class="fa fa-table"></i> My Grade Book</a></li>
                <li id="subj"><a href="#"><i class="fa fa-list"></i> My Subjects </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                 <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" style="margin-right: 10px"></i><?php echo $t_name ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('teacher'); ?>" id="logOut"><i class="fa fa-power-off"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>