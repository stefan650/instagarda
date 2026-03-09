</main>

<!-- Footer -->
<footer class="ig-footer">
    <div class="ig-container">
        <div class="ig-footer__grid">

            <!-- Brand Column -->
            <div class="ig-footer__col ig-footer__col--brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="ig-footer__logo">
                    <span class="ig-logo ig-logo--white">INSTA<span class="ig-logo__accent">GARDA</span></span>
                </a>
                <p class="ig-footer__desc">La guida completa per scoprire il Lago di Garda.</p>
                <div class="ig-footer__contact">
                    <a href="mailto:info@instagarda.net" class="ig-footer__email">info@instagarda.net</a>
                </div>
                <div class="ig-footer__social">
                    <a href="https://instagram.com/instagarda" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="ig-footer__social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://facebook.com/instagarda" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="ig-footer__social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="https://youtube.com/@instagarda" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="ig-footer__social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.43z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
                    </a>
                </div>
            </div>

            <!-- Destinazioni Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Destinazioni</h4>
                <ul class="ig-footer__links">
                    <?php
                    $luoghi = new WP_Query([
                        'post_type' => 'destinazione',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ]);
                    while ($luoghi->have_posts()): $luoghi->the_post();
                    ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>

            <!-- Esperienze Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Esperienze</h4>
                <ul class="ig-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/ristoranti/')); ?>">Ristoranti</a></li>
                    <li><a href="<?php echo esc_url(home_url('/musei/')); ?>">Cultura &amp; Musei</a></li>
                    <li><a href="<?php echo esc_url(home_url('/attivita/')); ?>">Attività &amp; Tour</a></li>
                    <li><a href="<?php echo esc_url(home_url('/eventi/')); ?>">Eventi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/dove-dormire/')); ?>">Soggiorni</a></li>
                </ul>
            </div>

            <!-- Progetto Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Progetto</h4>
                <ul class="ig-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/progetto/')); ?>">Chi Siamo</a></li>
                    <?php $blog_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/blog/'); ?>
                    <li><a href="<?php echo esc_url($blog_url); ?>">Blog</a></li>
                    <li><a href="https://instagram.com/instagarda" target="_blank" rel="noopener noreferrer">Instagram</a></li>
                </ul>
            </div>

            <!-- Supporto Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Supporto</h4>
                <ul class="ig-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/contatti/')); ?>">Contatti</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">Cookie Policy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/termini/')); ?>">Termini di Servizio</a></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="ig-footer__bottom">
        <div class="ig-container ig-footer__bottom-inner">
            <p class="ig-footer__copyright">&copy; <?php echo date('Y'); ?> INSTAGARDA</p>
            <div class="ig-footer__legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy</a>
                <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">Cookie</a>
                <a href="<?php echo esc_url(home_url('/termini/')); ?>">Termini</a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="igBackToTop" class="ig-back-to-top" aria-label="Torna in cima">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>
