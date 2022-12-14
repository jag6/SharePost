<?php require APPROOT . '/views/includes/header.php'; ?>
    <section class="posts">
        <?php flash('post_message'); ?>
        <section class="posts-header phi">
            <h1>Posts</h1>
            <a href="<?php echo URLROOT; ?>/new"><img src="<?php echo URLROOT; ?>/public/images/pencil.svg" alt="pencil">New Post</a>
        </section>
        <?php foreach($data['posts'] as $post) : ?>
            <section class="post">
                <section class="post-title">
                    <section>
                        <h2><?php echo $post -> title; ?></h2>
                    </section>
                    <div>
                        <p>Written by <?php echo $post -> first_name; ?> <?php echo $post -> last_name; ?> 
                            on 
                            <?php $date = new DateTime($post -> postCreated);
                            echo $date->format('d/m/y');?>
                        </p>
                    </div>
                </section>
                <section class="post-body snippet">
                    <section>
                        <?php $parsedown = new Parsedown();
                        echo $parsedown -> text(substr($post -> body, 0, 300).' .....'); 
                        ?>
                    </section>
                    <div>
                        <a href="<?php echo URLROOT; ?>/show/<?php echo $post -> postId; ?>">Read More</a>
                    </div>
                </section>
                <div class="line-break"></div>
            </section>
        <?php endforeach; ?>
    </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>