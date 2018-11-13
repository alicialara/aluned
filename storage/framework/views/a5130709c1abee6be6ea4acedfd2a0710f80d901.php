<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">
                                    <?php if(Auth::guest()): ?>
                                        Usuario invitado
                                    <?php else: ?>
                                    <?php echo e(Auth::user()->name); ?>

                                    <?php endif; ?>
                                </strong>
                            </span> <span class="text-muted text-xs block"><b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                        <?php else: ?>
                        <li>
                            <a href="<?php echo e(url('/logout')); ?>"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                            <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                        <?php endif; ?>

                    </ul>
                </div>
                <div class="logo-element">
                    LSIU
                </div>
            </li>
            <?php if(Auth::guest()): ?>
                <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
            <?php else: ?>
                <li class="<?php echo e(isActiveRoute('main')); ?>">
                    <a href="<?php echo e(url('/')); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li class="<?php echo e(isActiveRoute('forum')); ?>">
                    <a href="<?php echo e(url('/forum')); ?>" target="_blank"><i class="fa fa-coffee"></i> <span class="nav-label">Foro</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('encuesta')); ?>">
                    <a href="<?php echo e(url('/encuesta')); ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Encuestas</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('temas')); ?>">
                    <a href="<?php echo e(url('/temas')); ?>"><i class="fa fa-book"></i> <span class="nav-label">Temáticas</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('tareas')); ?>">
                    <a href="<?php echo e(url('/tareas')); ?>"><i class="fa fa-list"></i> <span class="nav-label">Tareas (individual)</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('apuntes')); ?>">
                    <a href="<?php echo e(url('/apuntes')); ?>"><i class="fa fa-pencil"></i> <span class="nav-label">Apuntes (individual)</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('messages')); ?>">
                    <a href="<?php echo e(url('/messages')); ?>"><i class="fa fa-comments"></i> <span class="nav-label">Chat</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('bookmarks')); ?>">
                    <a href="<?php echo e(url('/bookmarks')); ?>"><i class="fa fa-bookmark"></i> <span class="nav-label">Bookmarks</span> </a>
                </li>
                <li class="<?php echo e(isActiveRoute('glosario')); ?>">
                    <a href="<?php echo e(url('/glosario')); ?>"><i class="fa fa-book"></i> <span class="nav-label">Glosary</span> </a>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav>
