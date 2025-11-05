<?php
/**
 * Custom comment template with AJAX and login check
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title"><?php echo get_comments_number(); ?> Bình luận</h3>

        <ul class="comment-list">
            <?php
            wp_list_comments([
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => function ($comment, $args, $depth) {
            ?>
                    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="comment-body">
                            <div class="comment-avatar">
                                <?php echo get_avatar($comment, 60); ?>
                            </div>
                            <div class="comment-content">
                                <div class="comment-author">
                                    <strong><?php comment_author(); ?></strong>
                                    <span class="comment-date"><?php echo get_comment_date(); ?></span>
                                </div>
                                <div class="comment-text"><?php comment_text(); ?></div>
                                <?php if (is_user_logged_in()) : ?>
                                    <button class="reply-btn" data-commentid="<?php comment_ID(); ?>">Reply</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
            <?php
                }
            ]);
            ?>
        </ul>
    <?php endif; ?>

    <?php if (is_user_logged_in()) : ?>
        <!-- ✅ Form bình luận khi đã đăng nhập -->
        <div id="comment-form-wrapper" class="comment-form-wrapper">
            <h3>Make a Post</h3>
            <form id="ajax-comment-form" class="custom-comment-form">
    <textarea id="comment" name="comment" placeholder="What are you thinking..." required></textarea>
    <input type="hidden" id="comment_post_ID" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
    <input type="hidden" id="comment_parent" name="comment_parent" value="0">

    <div class="form-buttons">
        <button type="button" class="cancel-reply-btn" style="display:none;">Cancel Reply</button>
        <button type="submit" class="submit-btn">Share</button>
    </div>
</form>

        </div>

    <?php else : ?>
        <!-- ✅ Khi chưa đăng nhập -->
        <p class="must-login">
            Bạn cần <a href="<?php echo wp_login_url(get_permalink()); ?>">đăng nhập</a> để bình luận.
        </p>
    <?php endif; ?>

</div><!-- #comments -->

<!-- ✅ STYLE -->
<style>
.comment-list {
    list-style: none;
    padding: 0;
    margin-bottom: 40px;
}
.comment-body {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}
.comment-avatar img {
    border-radius: 50%;
}
.comment-content {
    margin-left: 15px;
    flex: 1;
}
.comment-author {
    font-weight: bold;
    color: #007bff;
}
.comment-date {
    font-size: 13px;
    color: #777;
    margin-left: 8px;
}
.reply-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}
.reply-btn:hover {
    background: #007bff;
}
.comment-form-wrapper {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
}
.custom-comment-form {
    display: flex;
    flex-direction: column;
}

.custom-comment-form .form-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
.custom-comment-form textarea {
    width: 100%;
    height: 120px;
    resize: none;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 10px;
    font-size: 15px;
}
.submit-btn,
.cancel-reply-btn {
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
}

.submit-btn {
    background: #007bff;
    color: #fff;
}

.submit-btn:hover {
    background: #0056b3;
}

.cancel-reply-btn {
    background: #ccc;
    color: #000;
}
.must-login {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 6px;
    text-align: center;
    font-size: 16px;
}
.must-login a {
    color: #007bff;
    font-weight: bold;
}
</style>

<!-- ✅ JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ajax-comment-form');
    const cancelBtn = document.querySelector('.cancel-reply-btn');
    let replyTo = null;

    // Xử lý nút Reply
    document.querySelectorAll('.reply-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            replyTo = this.dataset.commentid;
            document.getElementById('comment_parent').value = replyTo;
            const comment = document.getElementById('comment-' + replyTo);
            comment.appendChild(form);
            cancelBtn.style.display = 'inline-block';
        });
    });

    // Hủy reply
    cancelBtn.addEventListener('click', function () {
        replyTo = 0;
        document.getElementById('comment_parent').value = 0;
        document.querySelector('#comment-form-wrapper').appendChild(form);
        cancelBtn.style.display = 'none';
    });

    // Gửi comment bằng AJAX
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: new URLSearchParams({
                action: 'custom_submit_comment',
                comment: data.get('comment'),
                comment_post_ID: data.get('comment_post_ID'),
                comment_parent: data.get('comment_parent'),
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); // refresh sau khi gửi xong
            } else {
                alert('Lỗi khi gửi bình luận');
            }
        });
    });
});
</script>