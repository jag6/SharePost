<!DOCTYPE html>
<html lang="en">
<head>
    <?php require APPROOT . '/views/includes/stylesheets.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/public/images/logo.svg" type="image/svg">
    <!-- MetaData -->
    <meta name="description" content="<?php echo $data['post'] -> description; ?>">
    <meta name="author" content="<?php echo $data['user'] -> first_name;?> <?php echo $data['user'] -> last_name; ?>">
    <!-- Twitter MetaData -->
    <meta name="twitter:title" content="<?php echo $data['post'] -> title; ?>">
    <meta name="twitter:description" content="<?php echo $data['post'] -> description; ?>">
    <meta name="twitter:image" content="">
    <!-- Other Social Media MetaData -->
    <meta property="og:title" content="<?php echo $data['post'] -> title; ?>">
    <meta property="og:description" content="<?php echo $data['post'] -> description; ?>">
    <meta property="og:image" content="<?php echo $data['post'] -> image; ?>">
    <meta property="og:url" content="<?php echo URLROOT; ?>/<?php echo slug($data['post'] -> title); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['post'] -> title ?></title>
    <script src="<?php echo URLROOT; ?>/public/scripts/main.js" defer></script>
</head>
<body>
    <?php require APPROOT . '/views/includes/nav.php'; ?>
    <main>
        <section class="post show">
            <div class="back-btn">
                <a href="<?php echo URLROOT; ?>/posts"><img src="<?php echo URLROOT; ?>/public/images/backward.svg" alt="pencil">Back</a>
            </div>
            <section class="post-title">
                <h1><?php echo $data['post'] -> title; ?></h1>
                <div class="post-author">
                    <p>Written by <?php echo $data['user'] -> first_name; ?> <?php echo $data['user'] -> last_name; ?>  
                        on 
                        <?php $date = new DateTime($data['post'] -> created_at);
                        echo $date->format('d/m/y');?>
                    </p>
                </div>
            </section>
            <div class="post-image">
                <img src="<?php echo $data['post'] -> image; ?>" alt="<?php echo $data['post'] -> image_description; ?>">
            </div>
            <div class="post-body">
                <section>
                    <?php $parsedown = new Parsedown();
                    echo $parsedown -> text($data['post'] -> body); ?>
                </section>
                <?php if($data['post'] -> user_id == $_SESSION['user_id']) : ?>
                    <div class="show-btns">
                        <a href="<?php echo URLROOT; ?>/edit/<?php echo $data['post'] -> id ?>">EDIT</a>
                        <form action="<?php echo URLROOT; ?>/delete/<?php echo $data['post'] -> id; ?>" method="post">
                            <button type="submit">DELETE</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>