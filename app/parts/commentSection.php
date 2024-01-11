<!-- 掲示板コメント本文 -->
<?php
include("app/functions/comment_get.php");
?>

<section>
    <?php foreach ($comment_array as $comment) : ?>
        <!-- スレッドidとコメントのthreadが一致するとき -->
        <?php if ($thread["id"] == $comment["thread_id"]) : ?>
            <article>
                <div class="Wrapper">
                    <div class="nameArea">
                        <span>名前：</span>
                        <p class="username"><?php echo $comment["username"]; ?></p>
                        <time>：<?php echo $comment["post_date"]; ?></time>
                    </div>
                    <p class="comment"><?php echo $comment["body"]; ?></p>
                    <form action="app/functions/delete.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                        <input type="submit" value="削除" >
                    </form>
                </div>

            </article>
        <?php endif; ?>
    <?php endforeach ?>
</section>