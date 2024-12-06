

<?php if(isset($messagesErreur)): ?>
    <?php if(count($messagesErreur) > 0): ?>
        <div class="alert alert-danger mb-3 text-start" role="alert">
            <b>Erreur :</b>
            <ul class="mb-0">
            <?php $__currentLoopData = $messagesErreur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erreur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($erreur); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/html/auth-app/resources/views/messageErreur.blade.php ENDPATH**/ ?>