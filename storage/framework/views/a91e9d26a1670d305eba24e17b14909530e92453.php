

<?php $__env->startSection('title'); ?> Index <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center">
        <a href="<?php echo e(route('posts.create')); ?>" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php $__env->startSection('content'); ?>
    <div class="new-post">
        <a href="<?php echo e(route('posts.create')); ?>">+</a>
    </div>

    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post <?php echo e($post->trashed() ? 'deleted' : ''); ?>">
            <h3 class="title"title="<?php echo e($post->title); ?>"><?php echo e($post->title); ?></h3>
            <p class="post-info">
                <span class="author"><?php echo e($post->user->name); ?></span> at
                <span class="date"><?php echo e($post->created_at->format('d-m-y')); ?></span><br>
                <span class="slug"><?php echo e($post->slug); ?></span>
            </p>
            <p class="description"><?php echo e($post->description); ?></p>
            <div class="controls">
                <?php if(!$post->trashed()): ?>
                    <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="view-post">View</a>
                    <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="edit-post">Edit</a>
                <?php endif; ?>
                <form class="<?php echo e($post->trashed() ? '' : 'delete-post-form'); ?>"
                    action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <?php if($post->trashed()): ?>
                        <?php echo method_field('PATCH'); ?>
                    <?php else: ?>
                        <?php echo method_field('DELETE'); ?>
                    <?php endif; ?>
                    <input type="submit" value="<?php echo e($post->trashed() ? 'Restore Post' : 'Delete'); ?>"
                        class="<?php echo e($post->trashed() ? 'restore-post' : 'delete-post'); ?>">
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="delete-prompt">
        <div class="content">
            <p>Are you sure you want to delete this post?</p>
            <div class="prompt-controls mt-3">
                <button class="confirm">Confirm</button>
                <button class="cancel">Cancel</button>
            </div>
        </div>
    </div>
 
    <script defer>
   
        const modal = document.querySelector('.delete-prompt');
        const deleteForms = document.querySelectorAll('.delete-post-form');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
             
                e.preventDefault();
    
                modal.classList.add('active');
                
                [modal, document.querySelector('.delete-prompt .cancel')].forEach(element => {
                    element.addEventListener('click', function() {
                        modal.classList.remove('active');
                    });
                });
    
                document.querySelector('.delete-prompt .confirm').addEventListener('click', function() {
                    e.target.submit();
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ITI\Laravel\Lec 1\Lab 1\Project\resources\views/posts/index.blade.php ENDPATH**/ ?>