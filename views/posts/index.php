<div class="home">
    <div class="posts">
        <?php foreach ($posts as $post): ?>
        <div class="post">
            <div class="img">
                <a href="/post?id=<?php echo $post["id"] ?>">
                    <img src="./uploads/<?php echo $post["img"] ?>" alt="image">
                </a>
            </div>
            <div class="content">
                <a href="/post?id=<?php echo $post["id"] ?>" class="link">
                    <h1>
                        <?php echo $post["title"] ?>
                    </h1>
                </a>
                <p>
                    <?php echo htmlspecialchars_decode($post["desc"]) ?>
                </p>

                <a class="button link" href="/post?id=<?php echo $post["id"] ?>">Read More</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>