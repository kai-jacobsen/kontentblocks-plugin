<?php
/*
  Plugin Name: Kontentblocks
  Plugin URI: http://kontentblocks.de
  Description: Content modularization framework
  Version: 0.8.3
  Author: Kai Jacobsen
  Author URI: https://github.com/kai-jacobsen/kontentblocks
  Text Domain: Kontentblocks
  Domain Path: /languages
  GitHub Plugin URI: https://github.com/kai-jacobsen/kontentblocks
  License: MIT
 */

namespace Kontentblocks;

use Detection\MobileDetect;
use Kontentblocks\Ajax\AjaxCallbackHandler;
use Kontentblocks\Areas\AreaRegistry;
use Kontentblocks\Backend\Dynamic\DynamicAreas;
use Kontentblocks\Backend\Dynamic\GlobalModulesMenu;
use Kontentblocks\Backend\EditScreens\PostEditScreen;
use Kontentblocks\Backend\EditScreens\Layouts\EditScreenLayoutsRegistry;
use Kontentblocks\Backend\EditScreens\TaxonomyEditScreen;
use Kontentblocks\Backend\EditScreens\UserEditScreen;
use Kontentblocks\Hooks\Enqueues;
use Kontentblocks\Hooks\Capabilities;
use Kontentblocks\Modules\ModuleRegistry;
use Kontentblocks\Fields\FieldRegistry;
use Kontentblocks\Modules\ModuleViewsRegistry;
use Kontentblocks\Panels\PanelRegistry;
use Kontentblocks\Templating\Twig;
use Kontentblocks\Utils\_K;
use Kontentblocks\Utils\CommonTwig\SimpleTwig;
use Kontentblocks\Utils\JSONTransport;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple;
use Reframe\Autoloader;


/**
 * Class Kontentblocks
 * @package Kontentblocks
 */
Class Kontentblocks
{

    const VERSION = '0.8.3';
    const DEVMODE = true;
    const TABLEVERSION = '1.0.13';
    const DEBUG = false;
    const DEBUG_LOG = false;
    static $instance;
    static $AjaxHandler;
    public $Services;

    /**
     *
     */
    public function __construct()
    {
        self::bootstrap();

        $this->Services = new Pimple\Container();
        // setup services
        $this->setupTemplating();
        $this->setupRegistries();
        $this->setupUtilities();

        // load modules automatically, after areas were setup,
        // dynamic areas are on init/initInterface hook
        add_action('kb.areas.setup', array($this, 'loadModules'), 9);
        add_action('kb.areas.setup', array($this, 'loadPanels'), 10);
        add_action('after_setup_theme', array($this, 'setup'), 11);
    }

    /**
     * Define constants and require additional files
     */
    private static function bootstrap()
    {
        define('KB_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('KB_PLUGIN_PATH', plugin_dir_path(__FILE__));
        define('KB_COREMODULES_URL', plugin_dir_url(__FILE__) . 'core/Modules/Core/');
        define('KB_COREMODULES_PATH', plugin_dir_path(__FILE__) . 'core/Modules/Core/');
        define('KB_REFIELD_JS', plugin_dir_url(__FILE__) . 'core/Fields/Definitions/js/');
        define('KB_TEMPLATES_PATH', plugin_dir_path(__FILE__) . 'core/Templating/templates/');

        // Composer autoloader, depends on composer setup
        if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
            require_once dirname(__FILE__) . '/vendor/autoload.php';
        }
        // Kontentblocks autloader
        // Public API
        require_once dirname(__FILE__) . '/includes/wp-api.php';
        require_once dirname(__FILE__) . '/includes/kb-api.php';

        // File gets created during build process and contains one function
        // to get the current git hash or a random hash during development
        // hash is used to invalidate the local storage data
        if (file_exists(dirname(__FILE__) . '/build/hash.php')) {
            require_once(dirname(__FILE__) . '/build/hash.php');
        }

        if (is_admin()) {
            require_once dirname(__FILE__) . '/core/Utils/tables.php';
        }

    }

    private function setupTemplating()
    {
        // pimpled
        $this->Services['templating.twig.loader'] = function ($container) {
            return Twig::setupLoader($container);
        };

        $this->Services['templating.twig.public'] = function ($container) {
            return Twig::setupEnvironment($container);
        };

        $this->Services['templating.twig.fields'] = function ($container) {
            return Twig::setupEnvironment($container, false);
        };

        $this->Services['templating.twig.common'] = function ($container) {
            return SimpleTwig::init();
        };

    }

    private function setupRegistries()
    {
        $this->Services['registry.modules'] = function ($Services) {
            return new ModuleRegistry($Services);
        };


        $this->Services['registry.areas'] = function ($Services) {
            return new AreaRegistry($Services);
        };
        $this->Services['registry.moduleViews'] = function ($Services) {
            return new ModuleViewsRegistry($Services);
        };
        $this->Services['registry.fields'] = function ($Services) {
            return new FieldRegistry($Services);
        };
        $this->Services['registry.panels'] = function ($Services) {
            return new PanelRegistry($Services);
        };
        $this->Services['registry.screenLayouts'] = function ($Services) {
            return new EditScreenLayoutsRegistry($Services);
        };


    }

    private function setupUtilities()
    {
        $this->Services['utility.logger'] = function ($container) {
            $path = KB_PLUGIN_PATH . '/logs';

            $ajax = defined('DOING_AJAX') && DOING_AJAX;
            $Logger = new Logger('kontentblocks');
            if (Kontentblocks::DEBUG && is_user_logged_in() && apply_filters('kb.use.logger.console', true)) {
                if (!$ajax) {
                    $Logger->pushHandler(new BrowserConsoleHandler());
                    $Logger->addInfo(
                        'Hey there! Kontentblocks is running in dev mode but don\'t worry. Have a great day'
                    );
                }

                if (is_dir($path) && Kontentblocks::DEBUG_LOG) {
                    $Logger->pushHandler(new StreamHandler($path . '/debug.log'));
                }
            } else {
                $Logger->pushHandler(new NullHandler());
            }
            return $Logger;
        };

        $this->Services['utility.mobileDetect'] = function ($container) {
            return new MobileDetect();
        };

        $this->Services['utility.jsontransport'] = function ($container) {
            return new JSONTransport();
        };

        $this->Services['utility.ajaxhandler'] = function ($container) {
            return new AjaxCallbackHandler();
        };

        self::$AjaxHandler = $this->Services['utility.ajaxhandler'];


    }

    public static function onActivation()
    {
        if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
            require_once dirname(__FILE__) . '/vendor/autoload.php';
        }

        if (!is_dir(get_template_directory() . '/module-templates')) {
            mkdir(get_template_directory() . '/module-templates', 0775, true);
        }

        if (is_child_theme()) {
            if (!is_dir(get_stylesheet_directory() . '/module-templates')) {
                mkdir(get_stylesheet_directory() . '/module-templates', 0775, true);
            }
        }


        Capabilities::setup();


    }

    public static function onDeactivation()
    {
        delete_transient('kb_last_backup');
        delete_option('kb_dbVersion');
    }

    public static function onUnistall()
    {
        global $wpdb;
        $table = $wpdb->prefix . "kb_backups";
        $wpdb->query("DROP TABLE IF EXISTS $table");
    }

    public static function getService($service)
    {
        return Kontentblocks::getInstance()->Services[$service];
    }

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }

    public static function addService($service, $callable)
    {
        Kontentblocks::getInstance()->Services[$service] = $callable;
    }

    public function setup()
    {
        require_once dirname(__FILE__) . '/core/Hooks/setup.php';
        Capabilities::setup();

        add_theme_support('kontentblocks:clipboard');

        if (file_exists(get_template_directory() . '/kontentblocks.php')) {
            add_theme_support('kontentblocks');
            include_once(get_template_directory() . '/kontentblocks.php');
            _K::info('kontentblocks.php loaded from main theme');

        }

        if (is_child_theme() && file_exists(get_stylesheet_directory() . '/kontentblocks.php')) {
            add_theme_support('kontentblocks');
            include_once(get_stylesheet_directory() . '/kontentblocks.php');
            _K::info('kontentblocks.php loaded from childtheme');
        }


        if (current_theme_supports('kontentblocks')) {
            // Enqueues of front and backend scripts and styles is handled here
            // earliest hook: init
            Enqueues::setup();
            $this->i18n();
            $this->loadExtensions();
            $this->loadFields();
            $this->initInterface();

            add_post_type_support('page', 'kontentblocks');
            remove_post_type_support('page', 'revisions');
        }

    }

    public function i18n()
    {
        load_plugin_textdomain('Kontentblocks', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        Language\I18n::getInstance();

    }

    /**
     * Load Extensions
     * @since 1.0.0
     */
    public function loadExtensions()
    {
        include_once 'core/Extensions/ExtensionsBootstrap.php';
    }

    /**
     *  Load Field Definitions
     */
    public function loadFields()
    {
        foreach (glob(KB_PLUGIN_PATH . 'core/Fields/Definitions/*.php') as $file) {
            $this->Services['registry.fields']->add($file);
        }

        _K::info('Fields loaded');
    }

    /**
     *
     */
    public function initInterface()
    {
        /*
         * ----------------
         * Admin menus & custom post types
         * ----------------
         */
        // global areas post type and menu page management
        new DynamicAreas();
        // global templates post type and menu management
        new GlobalModulesMenu();
        /*
         * Main post edit screen handler
         * Post type must support 'kontentblocks"
         */
        new PostEditScreen();
        new TaxonomyEditScreen();
        new UserEditScreen();
    }

    /**
     * Load Module Files
     * Simply auto-includes all .php files inside the templates folder
     *
     * uses filter: kb_template_paths to register / modify path array from the outside
     */
    public function loadModules()
    {

        /** @var \Kontentblocks\Modules\ModuleRegistry $Registry */
        $Registry = $this->Services['registry.modules'];
        // add core modules path
        $paths = array(KB_COREMODULES_PATH);
        $paths = apply_filters('kb.module.paths', $paths);
        $paths = array_unique($paths);
        foreach ($paths as $path) {
            $dirs = glob($path . '[mM]odule*', GLOB_ONLYDIR);
            if (!empty($dirs)) {
                foreach ($dirs as $subdir) {
                    $files = glob($subdir . '/[mM]odule*.php');
                    foreach ($files as $template) {
                        if (strpos(basename($template), '__') === false) {
                            $Registry->add($template);
                        }
                    }
                }
            }
        }
        _K::info('Modules loaded');
        do_action('kb.modules.loaded');
        do_action('kb.init');
        _K::info('kb.init action fired. We\'re good to go.');

    }

    /**
     * Load Panel Files
     */
    public function loadPanels()
    {
        /** @var \Kontentblocks\Modules\ModuleRegistry $Registry */
        $Registry = $this->Services['registry.panels'];
        // add core modules path
        $paths = apply_filters('kb.panel.paths', array());
        $paths = array_unique($paths);
        foreach ($paths as $path) {
            $dirs = glob($path . '[pP]anel*', GLOB_ONLYDIR);
            if (!empty($dirs)) {
                foreach ($dirs as $subdir) {
                    $files = glob($subdir . '/[pP]anel*.php');
                    foreach ($files as $template) {
                        if (strpos(basename($template), '__') === false) {
                            $Registry->add($template);
                        }
                    }
                }
            }
            $files = glob($path . '*.php');
            foreach ($files as $template) {
                if (strpos(basename($template), '__') === false) {
                    $Registry->addByFile($template);
                }
            }
        }
        _K::info('Panels loaded');

        do_action('kb.panels.loaded');

    }

    /**
     * @return string
     */
    public function getPluginPath()
    {
        return trailingslashit(KB_PLUGIN_PATH);
    }

    /**
     * @return string
     */
    public function getPluginUrl()
    {
        return trailingslashit(KB_PLUGIN_URL);
    }

    public function getTemplatesPath()
    {
        return trailingslashit(KB_TEMPLATES_PATH);

    }
}

// end Kontentblocks

// Fire it up
add_action(
    'plugins_loaded',
    function () {
        Kontentblocks::getInstance();
    },
    5
);

register_activation_hook(__FILE__, array('\Kontentblocks\Kontentblocks', 'onActivation'));
register_deactivation_hook(__FILE__, array('\Kontentblocks\Kontentblocks', 'onDeactivation'));
register_uninstall_hook(__FILE__, array('\Kontentblocks\Kontentblocks', 'onUninstall'));