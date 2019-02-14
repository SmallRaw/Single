<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<link href="<?php $this->options->themeUrl('css/custom.css'); ?>" rel="stylesheet" type="text/css"/>

<main>
    <div class="wrap min">
        <section class="post-title">
            <h2><?php $this->title() ?></h2>
<?php if($this->authorId == $this->user->uid): ?>
            <a class="edit-link" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a>
<?php endif; ?>
            <div class="post-meta">
                <time class="date"><?php $this->date(); ?></time>
<?php if (!empty($this->options->post_meta) && in_array('show_category', $this->options->post_meta)): ?>
                <span class="category"><?php $this->category('，'); ?></span>
<?php endif; ?>
<?php if (!empty($this->options->post_meta) && in_array('show_tags', $this->options->post_meta)): ?>
                <span class="tags"><?php $this->tags('，', true, '暂无'); ?></span>
<?php endif; ?>
<?php if (!empty($this->options->post_meta) && in_array('show_comments', $this->options->post_meta)): ?>
                <span class="comments"><?php $this->commentsNum('%d °C'); ?></span>
<?php endif; ?>
            </div>
        </section>
        <article class="post-content">
            <?php $this->content(); ?>

            <div class=“buttons” style="padding: 10px 0; margin: 20px auto; width: 100%; font-size:16px; text-align: center;">
                <button id="rewardButton" disable="enable" onclick="var qr = document.getElementById('QR'); if (qr.style.display === 'none') {qr.style.display='block';} else {qr.style.display='none'}">
                    <span>打赏</span>
                </button>
                <div id="QR" style="display: none;">
                    <div id="wechat" style="display: inline-block">
                        <a class="fancybox" rel="group"><img id="wechat_qr" src="http://blog.smallraw.com/wx.png" alt="WeChat Pay"></a>
                        <p>微信打赏</p>
                    </div>
                    <div id="alipay" style="display: inline-block">
                        <a class="fancybox" rel="group"><img id="alipay_qr" src="http://blog.smallraw.com/zfb.png" alt="Alipay"></a>
                        <p>支付宝打赏</p>
                    </div>
                </div>
            </div>
        </article>
        <ul class="post-near">
            <li>上一篇: <?php $this->thePrev('%s','看完啦 (つд⊂)'); ?></li>
            <li>下一篇: <?php $this->theNext('%s','看完啦 (つд⊂)'); ?></li>
        </ul>
<?php if($this->options->author_text): ?>
        <section class="post-author">
            <figure>
                <?php $this->author->gravatar(200); ?>
            </figure>
            <div>
                <h4><?php $this->author(); ?></h4>
                <p><?php $this->options->author_text() ?></p>
            </div>
        </section>
<?php endif; ?>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>