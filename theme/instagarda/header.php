<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    <script type="text/javascript" src="https://embeds.iubenda.com/widgets/4fbb9e6e-f17b-47a7-acd1-683b3bcd5e3c.js"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content (accessibility) -->
<a href="#ig-main-content" class="ig-skip-link">Vai al contenuto principale</a>

<!-- Fixed Header -->
<header class="ig-header" id="igHeader">
    <div class="ig-header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ig-header__logo">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-cropped.png?v=2'); ?>" alt="Instagarda" class="ig-header__logo-img">
        </a>

        <!-- Desktop Navigation -->
        <nav class="ig-nav" id="igNav">

            <!-- Destinazioni Dropdown -->
            <div class="ig-nav__dropdown">
                <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-nav__link">
                    Destinazioni
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <div class="ig-nav__dropdown-menu">
                    <a href="<?php echo esc_url(home_url('/destinazioni/sirmione/')); ?>" class="ig-nav__dropdown-item">Sirmione</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/riva-del-garda/')); ?>" class="ig-nav__dropdown-item">Riva del Garda</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/malcesine/')); ?>" class="ig-nav__dropdown-item">Malcesine</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/limone-sul-garda/')); ?>" class="ig-nav__dropdown-item">Limone sul Garda</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/bardolino/')); ?>" class="ig-nav__dropdown-item">Bardolino</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/salo/')); ?>" class="ig-nav__dropdown-item">Salò</a>
                    <div class="ig-nav__dropdown-divider"></div>
                    <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-nav__dropdown-item ig-nav__dropdown-item--all">
                        Vedi tutte
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

            <!-- Esperienze Dropdown -->
            <div class="ig-nav__dropdown">
                <a href="<?php echo esc_url(home_url('/esperienze/')); ?>" class="ig-nav__link">
                    Esperienze
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <div class="ig-nav__dropdown-menu">
                    <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                        Percorsi & Sport
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
                        Cultura & Musei
                    </a>
                    <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Eventi
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 002-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 00-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/></svg>
                        Ristoranti
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                        Soggiorni
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>" class="ig-nav__dropdown-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 22h8"/><path d="M12 11v11"/><path d="M20 3H4l2 8h12l2-8z"/></svg>
                        Bar & Nightlife
                    </a>
                    <div class="ig-nav__dropdown-divider"></div>
                    <a href="<?php echo esc_url(home_url('/esperienze/')); ?>" class="ig-nav__dropdown-item ig-nav__dropdown-item--all">
                        Vedi tutte
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

            <!-- Direct Links -->
            <?php
            $blog_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/blog/');
            ?>
            <a href="<?php echo esc_url($blog_url); ?>" class="ig-nav__link">Blog</a>
            <a href="<?php echo esc_url(home_url('/progetto/')); ?>" class="ig-nav__link">Progetto</a>
        </nav>

        <!-- Right Section -->
        <div class="ig-header__right">
            <!-- AI Chat Button -->
            <button class="ig-header__ai-btn" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                <span>Garda Concierge</span>
            </button>
            <!-- Search Button -->
            <button class="ig-header__icon-btn" id="igSearchToggle" aria-label="Cerca">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>

            <!-- Language Switcher -->
            <?php if (function_exists('icl_get_languages')):
                $langs = icl_get_languages('skip_missing=0&orderby=code');
                $current = $langs[ICL_LANGUAGE_CODE] ?? null;
                $flags = ['it' => '&#127470;&#127481;', 'en' => '&#127468;&#127463;', 'de' => '&#127465;&#127466;'];
                $lang_order = ['it', 'en', 'de'];
                // Filter and reorder
                $ordered_langs = [];
                foreach ($lang_order as $c) { if (isset($langs[$c])) $ordered_langs[$c] = $langs[$c]; }
                $langs = $ordered_langs;
            ?>
            <div class="ig-lang-switcher">
                <button class="ig-header__lang-btn" aria-expanded="false">
                    <span class="ig-header__lang-flag"><?php echo wp_kses_post($flags[ICL_LANGUAGE_CODE] ?? ''); ?></span>
                    <span><?php echo esc_html(strtoupper(ICL_LANGUAGE_CODE)); ?></span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="ig-lang-switcher__menu">
                    <?php foreach ($langs as $code => $lang): if ($code === ICL_LANGUAGE_CODE) continue; ?>
                    <a href="<?php echo esc_url($lang['url']); ?>" class="ig-lang-switcher__item">
                        <span><?php echo wp_kses_post($flags[$code] ?? ''); ?></span>
                        <span><?php echo esc_html($lang['translated_name']); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php else: ?>
            <button class="ig-header__lang-btn">
                <span class="ig-header__lang-flag">&#127470;&#127481;</span>
                <span>IT</span>
            </button>
            <?php endif; ?>

            <!-- Search Overlay -->
            <div class="ig-search-overlay" id="igSearchOverlay">
                <div class="ig-search-overlay__inner">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="ig-search-overlay__form">
                        <input type="search" name="s" placeholder="Cerca destinazioni, strutture, articoli..." class="ig-search-overlay__input" id="igSearchInput" autocomplete="off">
                        <button type="submit" class="ig-search-overlay__submit" aria-label="Cerca">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </button>
                    </form>
                    <button class="ig-search-overlay__close" id="igSearchClose" aria-label="Chiudi ricerca">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <button class="ig-header__hamburger" id="igMenuToggle" aria-label="Menu" aria-expanded="false" aria-controls="igMobileMenu">
                <span class="ig-header__hamburger-icon ig-header__hamburger-icon--open">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </span>
                <span class="ig-header__hamburger-icon ig-header__hamburger-icon--close" style="display:none;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="ig-mobile-menu" id="igMobileMenu">
        <div class="ig-mobile-menu__inner">

            <!-- Destinazioni -->
            <div class="ig-mobile-menu__group">
                <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-mobile-menu__heading" data-toggle="mobile-dest">
                    Destinazioni
                </a>
                <div class="ig-mobile-menu__submenu" id="mobile-dest">
                    <a href="<?php echo esc_url(home_url('/destinazioni/sirmione/')); ?>">Sirmione</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/riva-del-garda/')); ?>">Riva del Garda</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/malcesine/')); ?>">Malcesine</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/limone-sul-garda/')); ?>">Limone sul Garda</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/bardolino/')); ?>">Bardolino</a>
                    <a href="<?php echo esc_url(home_url('/destinazioni/salo/')); ?>">Salò</a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-mobile-menu__link--all">Vedi tutte</a>
                </div>
            </div>

            <!-- Esperienze -->
            <div class="ig-mobile-menu__group">
                <a href="<?php echo esc_url(home_url('/esperienze/')); ?>" class="ig-mobile-menu__heading" data-toggle="mobile-vivi">
                    Esperienze
                </a>
                <div class="ig-mobile-menu__submenu" id="mobile-vivi">
                    <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                        Percorsi & Sport
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
                        Cultura & Musei
                    </a>
                    <a href="<?php echo esc_url(home_url('/eventi/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Eventi
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 002-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 00-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/></svg>
                        Ristoranti
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                        Soggiorni
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 22h8"/><path d="M12 11v11"/><path d="M20 3H4l2 8h12l2-8z"/></svg>
                        Bar & Nightlife
                    </a>
                    <a href="<?php echo esc_url(home_url('/esperienze/')); ?>" class="ig-mobile-menu__link--all">Vedi tutte</a>
                </div>
            </div>

            <!-- Direct Links -->
            <a href="<?php echo esc_url($blog_url); ?>" class="ig-mobile-menu__link">Blog</a>
            <a href="<?php echo esc_url(home_url('/progetto/')); ?>" class="ig-mobile-menu__link">Progetto</a>
        </div>
    </div>
</header>

<main class="ig-main" id="ig-main-content">
