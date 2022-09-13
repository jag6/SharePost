<?php require APPROOT . '/views/includes/header.php'; ?>

<?php require APPROOT . '/views/includes/topContainer.php'; ?>

<section class="post-list">
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
                <div>
                    <p><?php echo $post -> description; ?></p>
                </div>
                <div>
                    <a href="<?php echo URLROOT; ?>/show/<?php echo $post -> postId; ?>">Read More</a>
                </div>
            </section>
            <div class="line-break"></div>
        </section>
    <?php endforeach; ?>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>