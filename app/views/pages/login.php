<?php require APPROOT . '/views/includes/header.php'; ?>
    <section class="form">
        <?php flash('register_success'); ?></php>
        <?php require APPROOT . '/views/includes/topContainer.php'; ?>
        <form action="<?php echo URLROOT; ?>/login" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="<?php echo (!empty($form_data['email_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['email']; ?>">
                <span class="invalid"><?php echo $form_data['email_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="<?php echo (!empty($form_data['password_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['password']; ?>">
                <span class="invalid"><?php echo $form_data['password_error']; ?></span>
            </div>
            <div class="form-btns log-reg-btns">
                <div>
                    <button type="submit">LOGIN</button>
                </div>
                <div>
                    <a href="<?php echo URLROOT; ?>/register">No account?</a>
                </div>
            </div>
        </form>
    </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>