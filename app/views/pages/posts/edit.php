<?php require APPROOT . '/views/includes/header.php'; ?>
    <section class="posts new">
        <div class="back-btn">
            <a href="<?php echo URLROOT; ?>/posts"><img src="<?php echo URLROOT; ?>/public/images/backward.svg" alt="pencil">Back</a>
        </div>
        <section class="posts-header new-header">
            <h1><?php echo $data['title']; ?></h1>
        </section>
        <form action="<?php echo URLROOT; ?>/edit/<?php echo $form_data['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="<?php echo (!empty($form_data['title_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['title']; ?>">
                <span class="invalid"><?php echo $form_data['title_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="<?php echo (!empty($form_data['description_error'])) ? 'invalid' : ''; ?>"><?php echo $form_data['description']; ?></textarea>
                <span class="invalid"><?php echo $form_data['description_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" class="<?php echo (!empty($form_data['body_error'])) ? 'invalid' : ''; ?>" rows="15"><?php echo $form_data['body']; ?></textarea>
                <span class="invalid"><?php echo $form_data['body_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="<?php echo (!empty($form_data['image_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['image']; ?>">
                <span class="invalid"><?php echo $form_data['image_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Image Description:</label>
                <input type="text" name="image_description" class="<?php echo (!empty($form_data['image_description_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['image_description']; ?>">
                <span class="invalid"><?php echo $form_data['image_description_error']; ?></span>
            </div>
            <div class="form-btns">
                <div>
                    <button type="submit">SAVE</button>
                </div>
                <div class="cancel-btn">
                    <a href="<?php echo URLROOT; ?>/posts">Cancel</a>
                </div>
            </div>
        </form>
    </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>