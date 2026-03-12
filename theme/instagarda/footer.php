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
                <p class="ig-footer__desc">La guida completa al Lago di Garda: destinazioni, percorsi, cultura, eventi e consigli per vivere il lago tutto l'anno.</p>
                <div class="ig-footer__contact">
                    <a href="mailto:info@instagarda.net" class="ig-footer__email">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        info@instagarda.net
                    </a>
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
                    <a href="https://tiktok.com/@instagarda" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="ig-footer__social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 104 4V4a5 5 0 005 5"/></svg>
                    </a>
                </div>
            </div>

            <!-- Destinazioni Column (top 12 + link) -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Destinazioni</h4>
                <ul class="ig-footer__links ig-footer__links--2col">
                    <?php
                    $top_dests = [
                        'Sirmione', 'Desenzano', 'Salò', 'Gardone Riviera',
                        'Gargnano', 'Limone', 'Riva del Garda', 'Malcesine',
                        'Lazise', 'Bardolino', 'Peschiera', 'Garda',
                    ];
                    $footer_dests = get_transient('ig_footer_destinations');
                    if (false === $footer_dests) {
                        $luoghi = get_posts([
                            'post_type' => 'destinazione',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ]);
                        $footer_dests = [];
                        foreach ($luoghi as $l) {
                            $footer_dests[] = [
                                'title' => get_the_title($l),
                                'url'   => get_permalink($l),
                            ];
                        }
                        set_transient('ig_footer_destinations', $footer_dests, 12 * HOUR_IN_SECONDS);
                    }
                    $shown = 0;
                    foreach ($footer_dests as $dest):
                        $match = false;
                        foreach ($top_dests as $td) {
                            if (stripos($dest['title'], $td) !== false) { $match = true; break; }
                        }
                        if ($match && $shown < 12): $shown++;
                    ?>
                        <li><a href="<?php echo esc_url($dest['url']); ?>"><?php echo esc_html($dest['title']); ?></a></li>
                    <?php endif; endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(home_url('/destinazioni/')); ?>" class="ig-footer__more">Tutte le destinazioni &rarr;</a>
            </div>

            <!-- Esperienze Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Esperienze</h4>
                <ul class="ig-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>">Percorsi &amp; Sport</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>">Cultura &amp; Musei</a></li>
                    <li><a href="<?php echo esc_url(home_url('/eventi/')); ?>">Eventi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>">Ristoranti</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>">Dove Dormire</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>">Bar &amp; Nightlife</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/enogastronomia/')); ?>">Enogastronomia</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/benessere/')); ?>">Benessere &amp; Spa</a></li>
                    <li><a href="<?php echo esc_url(home_url('/esperienze/tour/')); ?>">Tour &amp; Escursioni</a></li>
                </ul>
            </div>

            <!-- Blog & Progetto Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Magazine</h4>
                <ul class="ig-footer__links">
                    <?php
                    $blog_posts = get_posts(['post_type' => 'post', 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC']);
                    foreach ($blog_posts as $bp):
                    ?>
                    <li><a href="<?php echo esc_url(get_permalink($bp)); ?>"><?php echo esc_html(wp_trim_words(get_the_title($bp), 6)); ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php $blog_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/blog/'); ?>
                <a href="<?php echo esc_url($blog_url); ?>" class="ig-footer__more">Tutti gli articoli &rarr;</a>
            </div>

            <!-- Info Column -->
            <div class="ig-footer__col">
                <h4 class="ig-footer__heading">Info</h4>
                <ul class="ig-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/progetto/')); ?>">Chi Siamo</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contatti/')); ?>">Contatti</a></li>
                    <li><a href="https://instagram.com/instagarda" target="_blank" rel="noopener noreferrer">Instagram</a></li>
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
            <p class="ig-footer__copyright">&copy; <?php echo esc_html(wp_date('Y')); ?> INSTAGARDA &mdash; La guida al Lago di Garda</p>
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
