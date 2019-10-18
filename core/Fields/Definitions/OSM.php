<?php

namespace Kontentblocks\Fields\Definitions;

use Kontentblocks\Fields\Field;

Class OSM extends Field
{

    // Defaults
    public static $settings = array(
        'type' => 'osm'
    );

    public static function init()
    {
<<<<<<< HEAD

        add_action('init', function () {
            wp_register_style('leaflet-css', KB_PLUGIN_URL . 'css/assets/' . 'leaflet_incl_geocoder.css');
            wp_register_script('leaflet-js', KB_PLUGIN_URL . 'js/third-party/leaflet.js');
//            wp_register_script('leaflet-geocoder', KB_PLUGIN_URL . 'js/vendor/leaflet.js');


            if (is_admin()) {
                wp_enqueue_style('leaflet-css');
                wp_enqueue_script('leaflet-js');
//                wp_enqueue_script('leaflet-geocoder');
            }
        }, 12);


    }


=======
        add_action('admin_enqueue_scripts', function () {
            wp_register_style('leaflet-css', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css');
            wp_enqueue_style('leaflet-css');
            wp_register_script('leaflet-js', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.js');
            wp_enqueue_script('leaflet-js');
        });
    }

>>>>>>> 206e700976eb3b082c0b018e598c85cc801f80eb
    /**
     * When this data is retrieved
     * @param $val
     *
     * @return array
     */
    public function prepareFrontendValue($val)
    {
        return $val;
    }


    /**
     * @param $val
     *
     * @return mixed
     */
    public function prepareFormValue($val)
    {
        if (!isset($val['lat']) && !isset($val['lng'])) {
            $val = null;
        }

        if (empty($val)) {
            return array(
                'lat' => '',
                'lng' => '',
            );
        }

        return $val;
    }


}