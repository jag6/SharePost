<?php require APPROOT . '/views/includes/header.php'; ?>
    <section class="posts">
        <section class="posts-header">
            <h1>Posts</h1>
            <a href="<?php echo URLROOT; ?>/posts/add"><img src="<?php echo URLROOT; ?>/public/images/pencil.svg" alt="pencil">New Post</a>
        </section>
        <?php foreach($data['posts'] as $post) : ?>
            <section class="post">
                <section class="post-title">
                    <section>
                        <h2><?php echo $post -> title; ?></h2>
                    </section>
                    <div>
                        <p>Written by <?php echo $post -> name; ?> on <?php echo $post -> postCreated; ?></p>
                    </div>
                </section>
                <div class="post-body">
                    <p><?php echo $post -> body; ?></p>
                    <div>
                        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post -> postId; ?>">Read More</a>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>