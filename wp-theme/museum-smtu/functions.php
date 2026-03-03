<?php
/**
 * Музей СПбГМТУ — functions.php
 * Bootstrap 5 + WordPress
 */

// ─── 1. Базовая настройка темы ───────────────────────────────────────────────
function museum_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    load_theme_textdomain('museum-smtu', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'museum_setup');

// ─── 2. Подключение стилей и скриптов ───────────────────────────────────────
function museum_scripts() {
    $ver = '1.0.0';

    wp_enqueue_style('bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
        [], '5.0.2');

    wp_enqueue_style('bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css',
        [], '1.11.0');

    wp_enqueue_style('museum-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap',
        [], null);

    wp_enqueue_style('museum-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        ['bootstrap', 'bootstrap-icons', 'museum-fonts'],
        $ver);

    wp_enqueue_script('bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
        [], '5.0.2', true);

    wp_enqueue_script('museum-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['bootstrap'], $ver, true);

    wp_localize_script('museum-main', 'museumData', [
        'homeUrl' => home_url('/'),
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'museum_scripts');

// ─── 3. Регистрация Custom Post Types ────────────────────────────────────────
function museum_register_cpts() {

    // CPT: Выпускники
    register_post_type('graduate', [
        'labels' => [
            'name'          => 'Выпускники',
            'singular_name' => 'Выпускник',
            'add_new'       => 'Добавить выпускника',
            'add_new_item'  => 'Новый выпускник',
            'edit_item'     => 'Редактировать выпускника',
            'search_items'  => 'Поиск выпускников',
            'not_found'     => 'Выпускники не найдены',
        ],
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'    => 'dashicons-groups',
        'menu_position'=> 5,
        'rewrite'      => ['slug' => 'graduate'],
        'show_in_rest' => true,
    ]);

    // CPT: Фотогалерея
    register_post_type('gallery_item', [
        'labels' => [
            'name'          => 'Фотогалерея',
            'singular_name' => 'Фото',
            'add_new'       => 'Добавить фото',
            'add_new_item'  => 'Новое фото',
        ],
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title', 'thumbnail', 'excerpt'],
        'menu_icon'    => 'dashicons-format-gallery',
        'menu_position'=> 6,
        'rewrite'      => ['slug' => 'gallery-item'],
        'show_in_rest' => true,
    ]);

    // Таксономия: категория галереи
    register_taxonomy('gallery_cat', 'gallery_item', [
        'labels' => [
            'name'          => 'Категории галереи',
            'singular_name' => 'Категория',
            'add_new_item'  => 'Добавить категорию',
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'gallery-cat'],
    ]);

    // CPT: Сотрудники (Администрация)
    register_post_type('staff', [
        'labels' => [
            'name'          => 'Администрация',
            'singular_name' => 'Сотрудник',
            'add_new'       => 'Добавить сотрудника',
            'add_new_item'  => 'Новый сотрудник',
        ],
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title', 'thumbnail'],
        'menu_icon'    => 'dashicons-admin-users',
        'menu_position'=> 7,
        'rewrite'      => ['slug' => 'staff'],
        'show_in_rest' => true,
    ]);

    // CPT: Документы
    register_post_type('museum_doc', [
        'labels' => [
            'name'          => 'Документы',
            'singular_name' => 'Документ',
            'add_new'       => 'Добавить документ',
            'add_new_item'  => 'Новый документ',
        ],
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title'],
        'menu_icon'    => 'dashicons-media-document',
        'menu_position'=> 8,
        'rewrite'      => ['slug' => 'museum-doc'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'museum_register_cpts');

// ─── 4. Мета-поля выпускника ─────────────────────────────────────────────────
function museum_add_metaboxes() {
    add_meta_box(
        'graduate_details',
        'Данные выпускника',
        'museum_graduate_metabox_html',
        'graduate', 'normal', 'high'
    );
    add_meta_box(
        'staff_details',
        'Данные сотрудника',
        'museum_staff_metabox_html',
        'staff', 'normal', 'high'
    );
    add_meta_box(
        'doc_details',
        'Данные документа',
        'museum_doc_metabox_html',
        'museum_doc', 'normal', 'high'
    );
}
add_action('add_meta_boxes', 'museum_add_metaboxes');

function museum_graduate_metabox_html($post) {
    wp_nonce_field('museum_save_graduate', 'museum_graduate_nonce');
    $year      = get_post_meta($post->ID, '_graduate_year', true);
    $specialty = get_post_meta($post->ID, '_graduate_specialty', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="graduate_year">Год окончания</label></th>
            <td><input type="number" id="graduate_year" name="graduate_year"
                       value="<?php echo esc_attr($year); ?>"
                       min="1899" max="<?php echo date('Y'); ?>" style="width:120px"></td>
        </tr>
        <tr>
            <th><label for="graduate_specialty">Специальность</label></th>
            <td><input type="text" id="graduate_specialty" name="graduate_specialty"
                       value="<?php echo esc_attr($specialty); ?>" style="width:100%"></td>
        </tr>
    </table>
    <p class="description">Содержимое поста — биография. Миниатюра — портрет.</p>
    <?php
}

function museum_staff_metabox_html($post) {
    wp_nonce_field('museum_save_staff', 'museum_staff_nonce');
    $role  = get_post_meta($post->ID, '_staff_role', true);
    $phone = get_post_meta($post->ID, '_staff_phone', true);
    $email = get_post_meta($post->ID, '_staff_email', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="staff_role">Должность</label></th>
            <td><input type="text" id="staff_role" name="staff_role"
                       value="<?php echo esc_attr($role); ?>" style="width:100%"></td>
        </tr>
        <tr>
            <th><label for="staff_phone">Телефон</label></th>
            <td><input type="text" id="staff_phone" name="staff_phone"
                       value="<?php echo esc_attr($phone); ?>" style="width:240px"></td>
        </tr>
        <tr>
            <th><label for="staff_email">Email</label></th>
            <td><input type="email" id="staff_email" name="staff_email"
                       value="<?php echo esc_attr($email); ?>" style="width:240px"></td>
        </tr>
    </table>
    <?php
}

function museum_doc_metabox_html($post) {
    wp_nonce_field('museum_save_doc', 'museum_doc_nonce');
    $file_url = get_post_meta($post->ID, '_doc_file_url', true);
    $date_str = get_post_meta($post->ID, '_doc_date', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="doc_file_url">URL файла</label></th>
            <td><input type="url" id="doc_file_url" name="doc_file_url"
                       value="<?php echo esc_attr($file_url); ?>" style="width:100%"
                       placeholder="https://..."></td>
        </tr>
        <tr>
            <th><label for="doc_date">Дата документа</label></th>
            <td><input type="text" id="doc_date" name="doc_date"
                       value="<?php echo esc_attr($date_str); ?>" style="width:160px"
                       placeholder="01.01.2024"></td>
        </tr>
    </table>
    <?php
}

function museum_save_metas($post_id) {
    // Graduate
    if (isset($_POST['museum_graduate_nonce']) &&
        wp_verify_nonce($_POST['museum_graduate_nonce'], 'museum_save_graduate') &&
        !defined('DOING_AUTOSAVE') && current_user_can('edit_post', $post_id)) {

        if (isset($_POST['graduate_year'])) {
            update_post_meta($post_id, '_graduate_year', absint($_POST['graduate_year']));
        }
        if (isset($_POST['graduate_specialty'])) {
            update_post_meta($post_id, '_graduate_specialty', sanitize_text_field($_POST['graduate_specialty']));
        }
    }

    // Staff
    if (isset($_POST['museum_staff_nonce']) &&
        wp_verify_nonce($_POST['museum_staff_nonce'], 'museum_save_staff') &&
        !defined('DOING_AUTOSAVE') && current_user_can('edit_post', $post_id)) {

        foreach (['staff_role', 'staff_phone', 'staff_email'] as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }

    // Doc
    if (isset($_POST['museum_doc_nonce']) &&
        wp_verify_nonce($_POST['museum_doc_nonce'], 'museum_save_doc') &&
        !defined('DOING_AUTOSAVE') && current_user_can('edit_post', $post_id)) {

        if (isset($_POST['doc_file_url'])) {
            update_post_meta($post_id, '_doc_file_url', esc_url_raw($_POST['doc_file_url']));
        }
        if (isset($_POST['doc_date'])) {
            update_post_meta($post_id, '_doc_date', sanitize_text_field($_POST['doc_date']));
        }
    }
}
add_action('save_post', 'museum_save_metas');

// ─── 5. Страница настроек музея ──────────────────────────────────────────────
function museum_add_settings_page() {
    add_options_page(
        'Настройки музея',
        'Музей СПбГМТУ',
        'manage_options',
        'museum-settings',
        'museum_settings_page_html'
    );
}
add_action('admin_menu', 'museum_add_settings_page');

function museum_settings_page_html() {
    if (!current_user_can('manage_options')) return;

    if (isset($_POST['museum_opts_nonce']) &&
        wp_verify_nonce($_POST['museum_opts_nonce'], 'museum_save_opts')) {

        $text_fields = [
            'phone', 'email', 'address', 'hours_weekday', 'hours_saturday', 'yandex_map_src',
            'hero_badge',
            'page_about_h1',       'page_about_sub',
            'page_visitors_h1',    'page_visitors_sub',
            'page_exposition_h1',  'page_exposition_sub',
            'page_contacts_h1',    'page_contacts_sub',
            'page_visit_rules_h1', 'page_visit_rules_sub',
            'page_lki_h1',         'page_lki_sub',
            'page_gallery_h1',     'page_gallery_sub',
            'page_graduates_h1',   'page_graduates_sub',
        ];
        $textarea_fields = ['hero_description', 'about_title', 'about_text1', 'about_text2'];

        $opts = [];
        foreach ($text_fields as $f) {
            $opts[$f] = isset($_POST[$f]) ? sanitize_text_field($_POST[$f]) : '';
        }
        foreach ($textarea_fields as $f) {
            $opts[$f] = isset($_POST[$f]) ? sanitize_textarea_field($_POST[$f]) : '';
        }
        update_option('museum_options', $opts);
        echo '<div class="notice notice-success"><p>Настройки сохранены.</p></div>';
    }

    $o  = get_option('museum_options', []);
    $g  = function($k, $d) use ($o) { return isset($o[$k]) && $o[$k] !== '' ? esc_attr($o[$k])     : esc_attr($d); };
    $gt = function($k, $d) use ($o) { return isset($o[$k]) && $o[$k] !== '' ? esc_textarea($o[$k]) : esc_textarea($d); };
    ?>
    <div class="wrap">
        <h1>Настройки музея СПбГМТУ</h1>
        <form method="post">
            <?php wp_nonce_field('museum_save_opts', 'museum_opts_nonce'); ?>

            <h2 class="title">Контактная информация</h2>
            <table class="form-table">
                <tr><th>Телефон</th>
                    <td><input type="text" name="phone" value="<?php echo $g('phone', '+7 (812) 123-45-67'); ?>" class="regular-text"></td></tr>
                <tr><th>Email</th>
                    <td><input type="email" name="email" value="<?php echo $g('email', 'museum@smtu.ru'); ?>" class="regular-text"></td></tr>
                <tr><th>Адрес</th>
                    <td><input type="text" name="address" value="<?php echo $g('address', 'ул. Лоцманская, 3, Санкт-Петербург'); ?>" class="regular-text"></td></tr>
                <tr><th>Часы работы Пн–Пт</th>
                    <td><input type="text" name="hours_weekday" value="<?php echo $g('hours_weekday', '10:00–17:00'); ?>" class="regular-text"></td></tr>
                <tr><th>Часы работы Суббота</th>
                    <td><input type="text" name="hours_saturday" value="<?php echo $g('hours_saturday', '11:00–15:00'); ?>" class="regular-text"></td></tr>
                <tr><th>Яндекс.Карта (src iframe)</th>
                    <td>
                        <input type="text" name="yandex_map_src" value="<?php echo $g('yandex_map_src', ''); ?>" class="large-text"
                               placeholder="https://yandex.ru/map-widget/v1/?...">
                        <p class="description">Вставьте URL из кода iframe с Яндекс.Карт</p>
                    </td></tr>
            </table>

            <h2 class="title">Главная страница</h2>
            <table class="form-table">
                <tr><th>Бейдж в шапке</th>
                    <td><input type="text" name="hero_badge" value="<?php echo $g('hero_badge', 'Основан в 1941 году'); ?>" class="regular-text"></td></tr>
                <tr><th>Описание (hero)</th>
                    <td><textarea name="hero_description" class="large-text" rows="3"><?php echo $gt('hero_description', 'Уникальная коллекция, раскрывающая историю Санкт-Петербургского морского технического университета — одного из старейших технических вузов России.'); ?></textarea></td></tr>
                <tr><th>Заголовок секции «О нас»</th>
                    <td><textarea name="about_title" class="large-text" rows="2"><?php echo $gt('about_title', 'Хранители морской истории России'); ?></textarea></td></tr>
                <tr><th>Первый абзац «О нас»</th>
                    <td><textarea name="about_text1" class="large-text" rows="3"><?php echo $gt('about_text1', 'Музей СПбГМТУ — один из крупнейших технических музеев Санкт-Петербурга. Основанный более 80 лет назад, он бережно хранит историю отечественного кораблестроения, судьбы выпускников и традиции главного морского вуза страны.'); ?></textarea></td></tr>
                <tr><th>Второй абзац «О нас»</th>
                    <td><textarea name="about_text2" class="large-text" rows="3"><?php echo $gt('about_text2', 'В фондах музея — модели кораблей, навигационные приборы, архивные документы, личные вещи выдающихся учёных и конструкторов, уникальные фотографии и артефакты, связанные с историей российского флота.'); ?></textarea></td></tr>
            </table>

            <h2 class="title">Заголовки страниц</h2>
            <p class="description" style="margin-bottom:12px">H1 и подзаголовок в верхней части каждой страницы.</p>
            <table class="form-table">
                <?php
                $pages = [
                    'about'       => ['О музее',              'История, документы и администрация Музея СПбГМТУ'],
                    'visitors'    => ['Посетителям',           'Правила, часы работы, виртуальный тур, лекторий и дополнительные услуги'],
                    'exposition'  => ['Экспозиция',            'Семь тематических залов, охватывающих всю историю отечественного кораблестроения'],
                    'contacts'    => ['Контакты',              'Адрес, телефон, email и маршруты до музея'],
                    'visit_rules' => ['Правила посещения',     'Условия посещения, режим работы и форма предварительной записи'],
                    'lki'         => ['История создания ЛКИ',  'От инженерного факультета 1899 года до одного из ведущих технических вузов России'],
                    'gallery'     => ['Фотогалерея',           'Фотографии экспонатов, залов музея, исторические снимки и архивные материалы'],
                    'graduates'   => ['Выдающиеся выпускники', 'База данных известных выпускников СПбГМТУ — инженеры, учёные, адмиралы, конструкторы'],
                ];
                foreach ($pages as $slug => [$def_h1, $def_sub]) :
                    $kh = "page_{$slug}_h1";
                    $ks = "page_{$slug}_sub";
                ?>
                <tr>
                    <th style="padding-bottom:4px">«<?php echo esc_html($def_h1); ?>» — H1</th>
                    <td><input type="text" name="<?php echo $kh; ?>" value="<?php echo $g($kh, $def_h1); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th style="padding-top:0;padding-bottom:16px;font-weight:400;color:#666">Подзаголовок</th>
                    <td style="padding-top:4px"><input type="text" name="<?php echo $ks; ?>" value="<?php echo $g($ks, $def_sub); ?>" class="large-text"></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <?php submit_button('Сохранить настройки'); ?>
        </form>
    </div>
    <?php
}

// ─── 6. Хелпер-функции ───────────────────────────────────────────────────────

/**
 * Получить настройку музея (с экранированием для вывода в HTML)
 */
function museum_opt($key, $default = '') {
    $opts = get_option('museum_options', []);
    return (isset($opts[$key]) && $opts[$key] !== '') ? esc_html($opts[$key]) : $default;
}

/**
 * Получить настройку музея без экранирования (для textarea-полей с nl2br)
 */
function museum_opt_raw($key, $default = '') {
    $opts = get_option('museum_options', []);
    return (isset($opts[$key]) && $opts[$key] !== '') ? $opts[$key] : $default;
}

/**
 * Вывести хлебные крошки
 * @param array $items ['Заголовок' => 'URL или null для текущей страницы']
 */
function museum_breadcrumbs(array $items) {
    echo '<nav aria-label="breadcrumb" class="breadcrumb-wrap"><div class="container">';
    echo '<ol class="breadcrumb mb-0">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">Главная</a></li>';
    $last = array_key_last($items);
    foreach ($items as $label => $url) {
        if ($label === $last || !$url) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($label) . '</li>';
        } else {
            echo '<li class="breadcrumb-item"><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
        }
    }
    echo '</ol></div></nav>';
}

/**
 * Проверить активную страницу (для класса nav-link)
 */
function museum_nav_active($slug) {
    return is_page($slug) ? 'active' : '';
}

/**
 * Проверить активную страницу или её потомков
 */
function museum_nav_active_section(array $slugs) {
    return is_page($slugs) ? 'active' : '';
}

/**
 * Получить URL страницы по слагу
 */
function museum_page_url($slug) {
    $page = get_page_by_path($slug);
    return $page ? get_permalink($page) : home_url('/' . $slug . '/');
}

// ─── 7. Колонки в списке выпускников в админке ───────────────────────────────
function museum_graduate_columns($cols) {
    return [
        'cb'               => $cols['cb'],
        'title'            => 'Имя выпускника',
        'graduate_year'    => 'Год выпуска',
        'graduate_specialty' => 'Специальность',
        'date'             => $cols['date'],
    ];
}
add_filter('manage_graduate_posts_columns', 'museum_graduate_columns');

function museum_graduate_column_data($col, $post_id) {
    if ($col === 'graduate_year') {
        echo esc_html(get_post_meta($post_id, '_graduate_year', true) ?: '—');
    }
    if ($col === 'graduate_specialty') {
        echo esc_html(get_post_meta($post_id, '_graduate_specialty', true) ?: '—');
    }
}
add_action('manage_graduate_posts_custom_column', 'museum_graduate_column_data', 10, 2);
add_filter('manage_edit-graduate_sortable_columns', function($cols) {
    $cols['graduate_year'] = 'graduate_year';
    return $cols;
});
