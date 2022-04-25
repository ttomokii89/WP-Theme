<footer class="footer">
    <div class="footer__body">
        <nav>
            <ul class="footer__menu">
                <li class="footer__menuItem"><a href="/about">About</a></li>
                <li class="footer__menuItem"><a href="/category/lostmortal">Notification</a></li>
                <li class="footer__menuItem"><a href="/blog">Blog</a></li>
                <li class="footer__menuItem"><a href="/music">Discography</a></li>
                <li class="footer__menuItem"><a href="mailto:hardcoreforever777@gmail.com">Contact</a></li>
                <li class="footer__menuItem"><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
        </nav>
        <small class="footer__copy">&copy; 2018-2021 Lostmortal</small>
    </div>
</footer>

<?php if(is_single() && !isset($_GET['amp'])): ?>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script async>
    document.addEventListener('DOMContentLoaded', function() {
        Array.prototype.forEach.call(document.querySelectorAll('.adsbygoogle'), function() {
            (adsbygoogle = window.adsbygoogle || []).push({});
        });
    });
</script>

<script async src="<?php echo get_template_directory_uri(); ?>/asset/js/entry.min.js?2008022"></script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>