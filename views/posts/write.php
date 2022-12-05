<?php foreach ($errors as $e): ?>
<p class="error">
    <?php echo $e ?>
</p>
<?php endforeach; ?>

<?php if ($post["img"]): ?>
<img src="./uploads/<?php echo $post["img"] ?>" alt="img" class="edit-image">
<?php endif; ?>

<form class="add" action="" method="POST" enctype="multipart/form-data">
    <div class="content">
        <input type="hidden" name="id" value="<?php echo $post["id"] ?>" />
        <input type="hidden" name="edit" value="<?php echo $post["id"] ? true : false ?>" />
        <input type="hidden" name="img" value="<?php echo $post["img"] ?>" />
        <input type="text" name="title" placeholder="Title*" value="<?php echo $post["title"] ?>" />
        <div class="editorContainer">
            <textarea name="description" cols="30" rows="10" class="editor" required>
                <?php echo $post["desc"] ?>
            </textarea>
        </div>
    </div>
    <div class="menu">
        <div class="item">
            <h1>Publish</h1>
            <span>
                <b>Status: </b> Draft
            </span>
            <span>
                <b>Visibility: </b> Public
            </span>
            <input type="file" name="image" class="file" />
            <label for="file" class="fileButton">Upload Image</label>
            <div class="buttons">
                <button class="button" type="submit">Publish</button>
            </div>
        </div>
        <div class="item">
            <h1>Category</h1>
            <div class="cat">
                <input type="radio" name="cat" value="art" id="art"
                    checked="<?php echo $post["cat"] === "art" ? true : false ?>">
                <label for="art">Art</label>
            </div>
            <div class="cat">
                <input type="radio" name="cat" value="science" id="science" <?php if ($post["cat"]==="science") echo
                    "checked" ?>>
                <label for="science">Science</label>
            </div>
            <div class="cat">
                <input type="radio" name="cat" value="tech" id="tech" <?php if ($post["cat"]==="tech") echo "checked"
                    ?>>
                <label for="tech">Technology</label>
            </div>
            <div class="cat">
                <input type="radio" name="cat" value="cinema" id="cinema" <?php if ($post["cat"] === "cinema")
                    echo
                        "checked" ?>>
                <label for="cinema">Cinema</label>
            </div>
            <div class="cat">
                <input type="radio" name="cat" value="design" id="design" <?php if ($post["cat"] === "design")
                    echo
                        "checked" ?>>
                <label for="design">Design</label>
            </div>
            <div class="cat">
                <input type="radio" name="cat" value="food" id="food" <?php if ($post["cat"] === "food")
                    echo "checked"
                    ?>>
                <label for="food">Food</label>
            </div>
        </div>
    </div>
</form>