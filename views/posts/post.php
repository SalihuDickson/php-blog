<?php $userImage = $post["userImage"] ?? null ?>

<div class="single">
    <div class="content">
        <img src="./uploads/<?php echo $post["img"] ?>" alt="post image">
        <div class="user">
            <?php if ($userImage): ?>
            <img src="<?php echo $userImage ?>" alt="" />
            <?php endif; ?>

            <div class="info">
                <span class="username">
                    <?php echo $post["username"] ?>
                </span>
                <p>
                    <?php echo $post["date"] ?>
                </p>
            </div>
            <?php if ($user && $user["id"] === $post["uid"]): ?>
            <div class="edit">
                <form action="/edit" method="POST">
                    <input type="hidden" name="id" value="<?php echo $post["id"] ?>">
                    <button type="submit">
                        <img src="./images/edit.png" alt="">
                    </button>
                </form>

                <form action="/posts/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $post["id"] ?>">
                    <button type="submit">
                        <img src="./images/delete.png" alt="">
                    </button>
                </form>
            </div>
            <?php endif; ?>

        </div>

        <h1>
            <?php echo $post["title"] ?>
        </h1>
        <p>
            <?php echo $post["desc"] ?>
        </p>
    </div>
    <?php include $menu ?>
</div>