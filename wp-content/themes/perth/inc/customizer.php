<?php
/**
 * Perth Theme Customizer
 *
 * @package Perth
 */

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function perth_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->get_section( 'title_tagline' )->priority = '9';
    $wp_customize->get_section( 'title_tagline' )->title = __('Site title/tagline/logo', 'perth');   
    $wp_customize->get_section( 'header_image' )->panel = 'perth_header_panel';

    //Titles
    class Perth_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }

    //Titles
    class Perth_Theme_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }    

    //___Header area___//
    $wp_customize->add_panel( 'perth_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'perth'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'perth_header_type',
        array(
            'title'         => __('Header type', 'perth'),
            'priority'      => 10,
            'panel'         => 'perth_header_panel', 
            'description'   => __('Select your header type', 'perth'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'perth_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'perth'),
            'section'     => 'perth_header_type',
            'description' => __('Select the header type for your front page', 'perth'),
            'choices' => array(
                'image'     => __('Image', 'perth'),
                'nothing'   => __('Only menu', 'perth')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'perth_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'perth'),
            'section'     => 'perth_header_type',
            'description' => __('Select the header type for all pages except the front page', 'perth'),
            'choices' => array(
                'image'     => __('Image', 'perth'),
                'nothing'   => __('Only menu', 'perth')
            ),
        )
    );

    //___Header text___//
    $wp_customize->add_section(
        'perth_header_text',
        array(
            'title'         => __('Header text', 'perth'),
            'priority'      => 14,
            'panel'         => 'perth_header_panel', 
        )
    );    
    $wp_customize->add_setting(
        'header_text',
        array(
            'default' => __('Welcome to Perth','perth'),
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_text',
        array(
            'label' => __( 'Header text', 'perth' ),
            'section' => 'perth_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'button_left',
        array(
            'default' => __('Start here','perth'),
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'button_left',
        array(
            'label' => __( 'Left button text', 'perth' ),
            'section' => 'perth_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'button_left_url',
        array(
            'default' => '#primary',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'button_left_url',
        array(
            'label' => __( 'Left button URL', 'perth' ),
            'section' => 'perth_header_text',
            'type' => 'text',
            'priority' => 11
        )
    );
    $wp_customize->add_setting(
        'button_right',
        array(
            'default' => __('Read more','perth'),
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'button_right',
        array(
            'label' => __( 'Right button text', 'perth' ),
            'section' => 'perth_header_text',
            'type' => 'text',
            'priority' => 12
        )
    );  
    $wp_customize->add_setting(
        'button_right_url',
        array(
            'default' => '#primary',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'button_right_url',
        array(
            'label' => __( 'Right button URL', 'perth' ),
            'section' => 'perth_header_text',
            'type' => 'text',
            'priority' => 11
        )
    );      

    //___Menu style___//
    $wp_customize->add_section(
        'perth_menu_style',
        array(
            'title'         => __('Menu style', 'perth'),
            'priority'      => 15,
            'panel'         => 'perth_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'perth_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'perth'),
            'section' => 'perth_menu_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'perth'),
                'static'   => __('Static', 'perth'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'perth_sanitize_menu_style',
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'perth'),
            'section'   => 'perth_menu_style',
            'choices'   => array(
                'inline'     => __('Inline', 'perth'),
                'centered'   => __('Centered', 'perth'),
            ),
        )
    );

    //Logo Upload
    $wp_customize->add_setting(
        'site_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'perth' ),
               'type'           => 'image',
               'section'        => 'title_tagline',
               'priority'       => 12,
            )
        )
    );

    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'perth'),
            'priority' => 13,
        )
    );  
    // Blog layout
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Perth_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'perth'),
        'section' => 'blog_options',
        'settings' => 'perth_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'perth_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'perth'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'classic'           => __( 'Classic', 'perth' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'perth' ),
                'masonry-layout'    => __( 'Masonry (grid style)', 'perth' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'perth_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'perth'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Perth_Info( $wp_customize, 'content', array(
        'label' => __('Content/excerpt', 'perth'),
        'section' => 'blog_options',
        'settings' => 'perth_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content posts
    $wp_customize->add_setting(
      'full_content_home',
      array(
        'sanitize_callback' => 'perth_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on the home page.', 'perth'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'sanitize_callback' => 'perth_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on all archives.', 'perth'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '55',
        )       
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'perth'),
        'description' => __('Choose your excerpt length. Default: 55 words', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ),
    ) );
    //Meta
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Perth_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'perth'),
        'section' => 'blog_options',
        'settings' => 'perth_options[info]',
        'priority' => 17
        ) )
    ); 
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'perth_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on index, archives?', 'perth'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'perth_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on singles?', 'perth'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    //Featured images
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Perth_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'perth'),
        'section' => 'blog_options',
        'settings' => 'perth_options[info]',
        'priority' => 21
        ) )
    );     
    //Index images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'sanitize_callback' => 'perth_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on index, archives etc.', 'perth'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'sanitize_callback' => 'perth_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on single posts', 'perth'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );

    //___Footer___//
    $wp_customize->add_section(
        'perth_footer',
        array(
            'title'         => __('Footer', 'perth'),
            'priority'      => 18,
        )
    );
    //Front page
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '2',
            'sanitize_callback' => 'perth_sanitize_fw',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'perth'),
            'section'     => 'perth_footer',
            'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'perth'),
            'choices' => array(
                '0'     => __('Disable', 'perth'),
                '1'     => __('One', 'perth'),
                '2'     => __('Two', 'perth'),
            ),
        )
    );

    //___Colors___//
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#315b9d',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'perth'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 11
            )
        )
    );
    //Menu bg
    $wp_customize->add_setting(
        'menu_bg_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg_color',
            array(
                'label' => __('Menu background', 'perth'),
                'section' => 'colors',
                'priority' => 12
            )
        )
    );     
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#2B3C4D',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'perth'),
                'section' => 'colors',
                'settings' => 'site_title_color',
                'priority' => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#808D99',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'perth'),
                'section' => 'colors',
                'priority' => 14
            )
        )
    );
    //Top level menu items
    $wp_customize->add_setting(
        'top_items_color',
        array(
            'default'           => '#53565A',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'top_items_color',
            array(
                'label' => __('Top level menu items', 'perth'),
                'section' => 'colors',
                'priority' => 15
            )
        )
    );
    //Sub menu items color
    $wp_customize->add_setting(
        'submenu_items_color',
        array(
            'default'           => '#d5d5d5',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_items_color',
            array(
                'label' => __('Sub-menu items', 'perth'),
                'section' => 'colors',
                'priority' => 16
            )
        )
    );
    //Sub menu background
    $wp_customize->add_setting(
        'submenu_background',
        array(
            'default'           => '#242D37',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'            
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_background',
            array(
                'label' => __('Sub-menu background', 'perth'),
                'section' => 'colors',
                'priority' => 17
            )
        )
    );
    //Header text
    $wp_customize->add_setting(
        'header_text_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_text_color',
            array(
                'label' => __('Header text', 'perth'),
                'section' => 'colors',
                'priority' => 18
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#798A9B',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'perth'),
                'section' => 'colors',
                'priority' => 19
            )
        )
    );    
    //Footer widget area
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => '#242D37',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_background',
            array(
                'label' => __('Footer widget area background', 'perth'),
                'section' => 'colors',
                'priority' => 22
            )
        )
    );
    //Rows overlay
    $wp_customize->add_setting(
        'rows_overlay',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'            
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rows_overlay',
            array(
                'label' => __('Rows overlay', 'perth'),
                'section' => 'colors',
                'priority' => 23
            )
        )
    );
    //Header overlay
    $wp_customize->add_setting(
        'header_overlay',
        array(
            'default'           => '#315B9D',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'            
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_overlay',
            array(
                'label' => __('Header overlay', 'perth'),
                'section' => 'colors',
                'priority' => 24
            )
        )
    );
    //Disable overlay
    $wp_customize->add_setting(
        'header_overlay_disable',
        array(
            'sanitize_callback' => 'perth_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'header_overlay_disable',
        array(
            'type'      => 'checkbox',
            'label'     => __('Disable the header overlay?', 'perth'),
            'section'   => 'colors',
            'priority'  => 25,
        )
    );
    //___Fonts___//
    $wp_customize->add_section(
        'perth_fonts',
        array(
            'title' => __('Fonts', 'perth'),
            'priority' => 15,
            'description' => __('Google Fonts can be found here: google.com/fonts. See the documentation if you need help in selecting Google Fonts: athemes.com/documentation/perth', 'perth'),
        )
    );
    //Body fonts title
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new perth_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'perth'),
        'section' => 'perth_fonts',
        'settings' => 'perth_options[info]',
        'priority' => 6
        ) )
    );    
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Roboto:500,300,500italic,300italic',
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'perth' ),
            'section' => 'perth_fonts',
            'type' => 'text',
            'priority' => 7
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Roboto\', sans-serif',
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'perth' ),
            'section' => 'perth_fonts',
            'type' => 'text',
            'priority' => 8
        )
    );
    //Headings fonts title
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new perth_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'perth'),
        'section' => 'perth_fonts',
        'settings' => 'perth_options[info]',
        'priority' => 9
        ) )
    );      
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Open+Sans:400italic,600italic,400,600,800',
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'perth' ),
            'section' => 'perth_fonts',
            'type' => 'text',
            'priority' => 10
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Open Sans\', sans-serif',
            'sanitize_callback' => 'perth_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Font family', 'perth' ),
            'section' => 'perth_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Font sizes title
    $wp_customize->add_setting('perth_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new perth_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'perth'),
        'section' => 'perth_fonts',
        'settings' => 'perth_options[info]',
        'priority' => 12
        ) )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'perth_fonts',
        'label'       => __('Site title', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 14,
        'section'     => 'perth_fonts',
        'label'       => __('Site description', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );  
    // Nav menu
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '13',
        )       
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'perth_fonts',
        'label'       => __('Menu items', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );    
    // Widget titles
    $wp_customize->add_setting(
        'pb_titles',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
        )       
    );
    $wp_customize->add_control( 'pb_titles', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'perth_fonts',
        'label'       => __('Widget titles (page builder)', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) ); 


    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'perth_fonts',
        'label'       => __('H1 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'perth_fonts',
        'label'       => __('H2 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'perth_fonts',
        'label'       => __('H3 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'perth_fonts',
        'label'       => __('H4 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'perth_fonts',
        'label'       => __('H5 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'perth_fonts',
        'label'       => __('H6 font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'perth_fonts',
        'label'       => __('Body font size', 'perth'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );

    //Header image size
    $wp_customize->add_setting(
        'header_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '600',
            'transport'         => 'postMessage'            
        )       
    );
    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 9,
        'section'     => 'header_image',
        'label'       => __('Header image height', 'perth'),
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 10,
            'style' => 'margin-bottom: 15px; padding: 10px;',
        ),
    ) );

    //___Theme info___//
    $wp_customize->add_section(
        'perth_themeinfo',
        array(
            'title' => __('Theme info', 'perth'),
            'priority' => 99,
            'description' => '<p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('1. Documentation for Perth can be found ', 'perth') . '<a target="_blank" href="http://athemes.com/documentation/perth/">here</a></p><p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('2. A full theme demo can be found ', 'perth') . '<a target="_blank" href="http://demo.athemes.com/themes/?theme=Perth">here</a></p>' . __('3. If you enjoy Perth and want to see what Perth Pro offers, please go ', 'perth') . '<a target="_blank" href="http://athemes.com/theme/perth-pro/">here</a></p>',         
        )
    );
    $wp_customize->add_setting('perth_theme_docs', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Perth_Theme_Info( $wp_customize, 'documentation', array(
        'section' => 'perth_themeinfo',
        'settings' => 'perth_theme_docs',
        'priority' => 10
        ) )
    );     

}
add_action( 'customize_register', 'perth_customize_register' );


/**
 * Sanitize
 */
//Header type
function perth_sanitize_header( $input ) {
    if ( in_array( $input, array( 'image', 'nothing' ), true ) ) {
        return $input;
    }
}
//Menu style
function perth_sanitize_menu_style( $input ) {
    if ( in_array( $input, array( 'inline', 'centered' ), true ) ) {
        return $input;
    }
}
//Menu style
function perth_sanitize_sticky( $input ) {
    if ( in_array( $input, array( 'sticky', 'static' ), true ) ) {
        return $input;
    }
}
//Footer widget areas
function perth_sanitize_fw( $input ) {
    if ( in_array( $input, array( '0', '1', '2' ), true ) ) {
        return $input;
    }
}
//Text
function perth_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Checkboxes
function perth_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Blog layout
function perth_sanitize_blog( $input ) {
    if ( in_array( $input, array( 'classic', 'fullwidth', 'masonry-layout' ), true ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function perth_customize_preview_js() {
    wp_enqueue_script( 'perth_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'perth_customize_preview_js' );