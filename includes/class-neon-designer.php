public function display_plugin_admin_dashboard() {
    ?>
    <div class="wrap">
        <h2>Neon Designer by Linely</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('neon_designer_options_group');
            do_settings_sections('neon-designer-by-linely');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

public function setup_plugin_options() {
    add_settings_section(
        'neon_designer_setting_section',
        'Ustawienia Designera Neonu',
        null,
        'neon-designer-by-linely'
    );

    add_settings_field(
        'neon_color',
        'Kolor Neonu',
        array($this, 'neon_color_callback'),
        'neon-designer-by-linely',
        'neon_designer_setting_section'
    );

    register_setting('neon_designer_options_group', 'neon_color');
}

public function neon_color_callback() {
    ?>
    <input type="text" name="neon_color" value="<?php echo get_option('neon_color'); ?>" />
    <?php
}

public function run() {
    add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
    add_action('admin_init', array($this, 'setup_plugin_options'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles_scripts'));
}


public function enqueue_admin_styles_scripts($hook) {
    if ('toplevel_page_neon-designer-by-linely' != $hook) {
        return;
    }

    wp_enqueue_style('neon-designer-admin-style', plugin_dir_url(__FILE__) . '../admin/css/admin-style.css', array(), NEON_DESIGNER_VERSION, 'all');
    wp_enqueue_script('neon-designer-admin-script', plugin_dir_url(__FILE__) . '../admin/js/admin-script.js', array('jquery'), NEON_DESIGNER_VERSION, true);
}

public function enqueue_public_styles_scripts() {
    wp_enqueue_style('neon-designer-public-style', plugin_dir_url(__FILE__) . '../public/css/public-style.css', array(), NEON_DESIGNER_VERSION, 'all');
    wp_enqueue_script('neon-designer-public-script', plugin_dir_url(__FILE__) . '../public/js/public-script.js', array('jquery'), NEON_DESIGNER_VERSION, true);
}

public function run() {
    // Dodajemy nasze hooki jak wcześniej, plus:
    add_action('wp_enqueue_scripts', array($this, 'enqueue_public_styles_scripts'));
}

public function register_shortcodes() {
    add_shortcode('neon_designer', array($this, 'render_neon_designer_shortcode'));
}

public function render_neon_designer_shortcode($atts) {
    // Pobierz aktualną wartość koloru z opcji
    $color = get_option('neon_color', '#ff0000');

    // Generuj HTML konfiguratora
    $html = '<div id="neon-designer-container">';
    $html .= '<input type="color" id="neon_color_input" value="'. esc_attr($color) .'">';
    $html .= '<div id="neon-preview" style="color:'. esc_attr($color) .';">Podgląd neonu</div>';
    $html .= '</div>';

    return $html;
}

public function run() {
    // Dodajemy nasze hooki jak wcześniej, plus:
    add_action('init', array($this, 'register_shortcodes'));
}
