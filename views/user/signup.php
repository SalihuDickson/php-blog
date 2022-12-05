<div class="auth">
    <h1>Register</h1>
    <form action="" method="post">
        <input type="text" name="username" id="" placeholder="username*" required>
        <input type="email" name="email" id="" placeholder="email*" required>
        <input type="password" name="password" id="" placeholder="password*" required>
        <button type="submit">Register</button>
        <?php foreach ($errors as $error): ?>
        <p class="error">
            <?php echo $error ?>
        </p>
        <?php endforeach; ?>
        <span>
            Do you have an account? <a class="link" href="<?php echo $loginLink ?>">Login</a>
        </span>
    </form>
</div>