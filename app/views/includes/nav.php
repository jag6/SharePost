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
        <?php if(isset($_SESSION['user_id'])) :?>
        <div>
            <ul>
                <li>
                    <a href="<?php echo URLROOT; ?>/posts">POSTS</a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        <div class="navbar-right">
            <ul>
                <?php if(isset($_SESSION['user_id'])) :?>
                <li>
                    <a class="user-name-nav" href="">Welcome, <?php echo $_SESSION['user_name']; ?></a>
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