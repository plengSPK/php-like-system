<?php require_once 'process.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LIKE System</title>

    <!-- Add font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />

    <!-- Add JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Style -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php $result = $conn->query("SELECT * FROM posts"); ?>

    <div class="posts-wrapper">
        <?php while ($post = $result->fetch_assoc()): ?>
            <div class="post">
                <?= $post['text']; ?>
                <div class="post-info">
                    <!-- like btn -->
                    <i 
                        <?php if(userLiked($post['id'])): ?>
                            class="fa fa-thumbs-up like-btn" 
                        <?php else: ?>
                            class="far fa-thumbs-up like-btn" 
                        <?php endif; ?>

                        data-id="<?= $post['id']?>"></i>
                    <span class="likes"><?= getLikes($post['id']); ?></span>

                    <!-- dislike btn -->
                    <i 
                        <?php if(userDisliked($post['id'])): ?>
                            class="fa fa-thumbs-down dislike-btn" 
                        <?php else: ?>
                            class="far fa-thumbs-down dislike-btn" 
                        <?php endif; ?>

                        data-id="<?= $post['id']?>"></i>
                    <span class="dislikes"><?= getDislikes($post['id']); ?></span>
                </div>
            </div>
        <?php endwhile;?>        
    </div>

    <!-- Script -->
    <script src="script.js"></script>

</body>
</html>