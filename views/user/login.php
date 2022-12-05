<div class="auth">
    <h1>Login</h1>
    <form action="" method="POST">
        <input type=" email" name="email" id="" placeholder="email*">
        <input type="password" name="password" id="" placeholder="password*">
        <button>Login</button>
        <?php foreach ($errors as $e): ?>
        <p class="error">
            <?php echo $e ?>
        </p>
        <?php endforeach; ?>
        <span>
            Don't have an account? <a class="link" href="<?php echo $signupLink ?>">Sign Up</a>
        </span>
    </form>
</div>