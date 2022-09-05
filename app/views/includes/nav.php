<header>
    <nav>
        <div class="navbar-left">
            <div class="logo"><a href="<?php echo URLROOT; ?>"><img src="<?php echo URLROOT; ?>/public/images/logo.svg" alt="SharePost logo"></a></div>
            <ul>
                <li>
                    <a href="<?php echo URLROOT; ?>">HOME</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/about">ABOUT</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/faq">FAQ</a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <ul>
                <?php if(isset($_SESSION['user_id'])) :?>
                <li>
                    <a href="<?php echo URLROOT; ?>/posts">POSTS</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/logout">LOGOUT</a>
                </li>
                <?php else : ?>
                <li>
                    <a href="<?php echo URLROOT; ?>/register">REGISTER</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/login">LOGIN</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>