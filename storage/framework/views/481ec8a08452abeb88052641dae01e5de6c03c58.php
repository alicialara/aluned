<div class="media">
    <a class="pull-left" href="#">
        <img src="//www.gravatar.com/avatar/<?php echo e(md5($message->user->email)); ?> ?s=64"
             alt="<?php echo e($message->user->name); ?>" class="img-circle">
    </a>
    <div class="media-body">
        <h5 class="media-heading"><?php echo e($message->user->name); ?></h5>
        <p><?php echo e($message->body); ?></p>
        <div class="text-muted">
            <small>Posted <?php echo e($message->created_at->diffForHumans()); ?></small>
        </div>
    </div>
</div>