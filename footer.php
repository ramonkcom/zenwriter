        </main><!-- .main -->
        <a class="scroll-to-top button button--icon" href="#main">
            <span class="icon-up"></span>
        </a><!-- .scroll-to-top -->
        <footer class="footer">
            <div class="grid-container">
                <div class="footer__content">
                    <?php
                    $custom_footer_copy = trim(get_theme_mod('zenwriter_setting_footer-copy'));
                    if ('' != $custom_footer_copy) :
                    ?>
                    <span class="footer__copy">
                        <?php echo $custom_footer_copy; ?>
                    </span><!-- .footer__copy -->
                    <?php endif; ?>
                    <span class="footer__zenwriter">
                        <?php bloginfo('name'); ?> on Zenwriter 2019 - <?php echo date('Y'); ?>
                    </span>
                </div><!-- .footer__content -->
            </div><!-- .grid-container -->
        </footer><!-- .footer -->
        <?php wp_footer(); ?>
    </body>
</html>