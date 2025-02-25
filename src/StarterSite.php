<?php

/**
 * StarterSite class
 * This class is used to add custom functionality to the theme.
 */

namespace App;

use Timber\Site;
use Timber\Timber;
use Twig\Environment;
use Twig\TwigFilter;

/**
 * Class StarterSite.
 */
class StarterSite extends Site {



	/**
	 * StarterSite constructor.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
        add_action( 'after_setup_theme', array( $this, 'theme_remove_supports' ) );

		add_action( 'init', [ $this, 'register_post_types' ] );
		add_action( 'init', [ $this, 'register_taxonomies' ] );
		add_action( 'init', [ $this, 'theme_add_static_routes' ] );
        add_action( 'admin_init', [ $this, 'vcard_settings_api_init' ] );

		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig/filters', [ $this, 'add_filters_to_twig' ] );
		add_filter( 'timber/twig/functions', [ $this, 'add_functions_to_twig' ] );
		add_filter( 'timber/twig/environment/options', [ $this, 'update_twig_environment_options' ] );

		parent::__construct();
	}

	/**
	 * This is where you can register custom post types.
	 */
	public function register_post_types() {

    }

	/**
	 * This is where you can register custom taxonomies.
	 */
	public function register_taxonomies() {

    }

	/**
	 * This is where you add some context.
	 *
	 * @param array $context context['this'] Being the Twig's {{ this }}
	 */
	public function add_to_context( $context ) {
        foreach (array_keys(get_nav_menu_locations()) as $location) {
            $menu = Timber::get_menu($location);
            $context[$location] = $menu;
        }

        $solutions_obj = get_page_by_path('solutions');
        $solutions_obj_args = array(
            'pagename' => 'solutions'
        );
        $context['solutions_obj'] = Timber::get_posts($solutions_obj_args);
        if (isset($solutions_obj->ID)) {
            $solutions_args = array(
                'post_parent' => $solutions_obj->ID,
                'post_type' => 'page',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1
            );
            $context['solutions'] = Timber::get_posts($solutions_args);
        }

        $industries_obj_args = array(
            'pagename' => 'industries'
        );
        $context['industries_obj'] = Timber::get_posts($industries_obj_args);

        $features_obj = get_page_by_path('features');
        $features_obj_args = array(
            'pagename' => 'features'
        );
        $context['features_obj'] = Timber::get_posts($features_obj_args);
        if (isset($features_obj->ID)) {
            $features_args = array(
                'post_parent' => $features_obj->ID,
                'post_type' => 'page',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1
            );
            $context['features'] = Timber::get_posts($features_args);
        }

        $cta2_obj_args = array(
            'pagename' => 'cta2'
        );
        $context['cta2_obj'] = Timber::get_posts($cta2_obj_args);

        $faq_obj = get_page_by_path('faq');
        $faq_obj_args = array(
            'pagename' => 'faq'
        );
        $context['faq_obj'] = Timber::get_posts($faq_obj_args);
        if (isset($faq_obj->ID)) {
            $faq_args = array(
                'post_parent' => $faq_obj->ID,
                'post_type' => 'page',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1
            );
            $context['faq'] = Timber::get_posts($faq_args);
        }

        $digits_obj_args = array(
            'pagename' => 'digits'
        );
        $context['digits_obj'] = Timber::get_posts($digits_obj_args);

        $blog_obj_args = array(
            'pagename' => 'blog'
        );
        $context['blog_obj'] = Timber::get_posts($blog_obj_args);

        $blog_args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 3
        );
        $context['blog'] = Timber::get_posts($blog_args);

        $cta3_obj_args = array(
            'pagename' => 'cta3'
        );
        $context['cta3_obj'] = Timber::get_posts($cta3_obj_args);

        $contacts_obj_args = array(
            'pagename' => 'contacts'
        );
        $context['contacts_obj'] = Timber::get_posts($contacts_obj_args);

        $context['site']  = $this;

		return $context;
	}

	/**
	 * This is where you can add your theme supports.
	 */
	public function theme_supports() {
		// Register navigation menus
		register_nav_menus(
			[
				'primary_navigation' => 'Header navigation',
				'footer_navigation' => 'Footer navigation',
				'handheld_navigation' => 'Handheld navigation',
			]
		);

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			[
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			]
		);

		add_theme_support( 'menus' );
	}

    public function theme_remove_supports() {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');

        add_filter('show_admin_bar', '__return_false');
    }

    function theme_add_static_routes() {
        wp_scripts()->add_data( 'jquery', 'group', 1 );
        wp_scripts()->add_data( 'jquery-core', 'group', 1 );
        wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

        wp_enqueue_script('jquery');
        wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 'jquery', '', true);
        wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/assets/scripts/script.js', 'jquery', '', true);
    }

	/**
	 * This would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';

		return $text;
	}

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @link https://timber.github.io/docs/v2/hooks/filters/#timber/twig/filters
	 * @param array $filters an array of Twig filters.
	 */
	public function add_filters_to_twig( $filters ) {

		$additional_filters = [
			'myfoo' => [
				'callable' => [ $this, 'myfoo' ],
			],
		];

		return array_merge( $filters, $additional_filters );
	}


	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @link https://timber.github.io/docs/v2/hooks/filters/#timber/twig/functions
	 * @param array $functions an array of existing Twig functions.
	 */
	public function add_functions_to_twig( $functions ) {
		$additional_functions = [
			'get_theme_mod' => [
				'callable' => 'get_theme_mod',
			],
		];

		return array_merge( $functions, $additional_functions );
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @see https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * @param array $options an array of environment options
	 *
	 * @return array
	 */
	public function update_twig_environment_options( $options ) {
		// $options['autoescape'] = true;

		return $options;
	}

    function vcard_settings_api_init() {
        add_settings_section(
            'vcard_setting_section',
            'Contacts',
            [$this, 'vcard_setting_section_callback_function'],
            'general'
        );
        add_settings_field(
            'vcard_setting_tg',
            'Telegram',
            [$this, 'vcard_setting_callback_tg_function'],
            'general',
            'vcard_setting_section'
        );
        add_settings_field(
            'vcard_setting_skype',
            'Skype',
            [$this, 'vcard_setting_callback_skype_function'],
            'general',
            'vcard_setting_section'
        );
        register_setting( 'general', 'vcard_setting_tg' );
        register_setting( 'general', 'vcard_setting_skype' );
    }

    function vcard_setting_section_callback_function() {
        //echo '<p></p>';
    }

    function vcard_setting_callback_tg_function() {
        echo '<input 
		name="vcard_setting_tg" 
		type="url" 
		value="' . get_option( 'vcard_setting_tg' ) . '" 
		class="code"
	 />';
    }
    function vcard_setting_callback_skype_function() {
        echo '<input 
		name="vcard_setting_skype"  
		type="url" 
		value="' . get_option( 'vcard_setting_skype' ) . '" 
		class="code"
	 />';
    }
}
