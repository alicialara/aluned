<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert <?php echo e($class); ?>">
    <h4 class="media-heading">
        <a href="<?php echo e(route('messages.show', $thread->id)); ?>"><?php echo e($thread->subject); ?></a>
        (<?php echo e($thread->userUnreadMessagesCount(Auth::id())); ?> unread)</h4>
    <p>
        <?php echo e($thread->latestMessage->body); ?>

    </p>
    <p>
        <small><strong>Creator:</strong> <?php echo e($thread->creator()->name); ?></small>
    </p>
    <p>
        <small><strong>Participants:</strong> <?php echo e($thread->participantsString(Auth::id())); ?></small>
    </p>
</div>