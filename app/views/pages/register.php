<?php require APPROOT . '/views/includes/header.php'; ?>

    <section class="form">
        <?php require APPROOT . '/views/includes/topContainer.php'; ?>
        <form action="<?php echo URLROOT; ?>/register" method="post">
            <div class="form-group">
                <label for="first_name"> First Name:</label>
                <input type="text" name="first_name" class="<?php echo (!empty($form_data['first_name_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['first_name']; ?>">
                <span class="invalid"><?php echo $form_data['first_name_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="<?php echo (!empty($form_data['last_name_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['last_name']; ?>">
                <span class="invalid"><?php echo $form_data['last_name_error']; ?></span>
            </div>
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
            <div class="form-group">
                <label for="confirm_password"> Confirm Password:</label>
                <input type="password" name="confirm_password" class="<?php echo (!empty($form_data['confirm_password_error'])) ? 'invalid' : ''; ?>" value="<?php echo $form_data['confirm_password']; ?>">
                <span class="invalid"><?php echo $form_data['confirm_password_error']; ?></span>
            </div>
            <div class="form-btns log-reg-btns">
                <div>
                    <button type="submit">REGISTER</button>
                </div>
                <div>
                    <a href="<?php echo URLROOT; ?>/login">Have an account?</a>
                </div>
            </div>
        </form>
    </section>

<?php require APPROOT . '/views/includes/footer.php'; ?>