<div class="menu">
    <h1>Other posts you may like</h1>

    <?php foreach ($similarPosts as $post): ?>
    <div class="post">
        <a href="/post?id=<?php echo $post["id"] ?>">
            <img src="./uploads/<?php echo $post["img"] ?>" alt="">
        </a>
        <h2>
            <?php echo $post["title"] ?>
        </h2>
        <a href="/post?id=<?php echo $post["id"] ?>" class="button link">Read More</a>
    </div>
    <?php endforeach; ?>

</div>