<nav class="navbar">
    <div class="container">
        <a href="<?php echo $home ?>" class="link">
            <div class="logo">
                <img src="./images/logo.png" alt="logo">
            </div>
        </a>
        <div class="links">
            <?php foreach ($links as $link): ?>
            <a href="/?cat=<?php echo $link ?>" class="link">
                <h6>
                    <?php echo $link ?>
                </h6>
            </a>
            <?php endforeach; ?>
            <span>
                <?php echo $user["username"] ?? "" ?>
            </span>
            <?php if ($user): ?>
            <a href="<?php echo $logoutLink ?>" class="link">Logout</a>
            <?php else: ?>
            <a href="<?php echo $loginLink ?>" class="link">Signin</a>
            <?php endif; ?>
            <a href="<?php echo $createLink ?>" class="write link">
                <div class="link">Write</div>
            </a>
        </div>
    </div>
</nav>