<?php

namespace Kontentblocks\Fields\Definitions;

use Kontentblocks\Customizer\CustomizerIntegration;
use Kontentblocks\Fields\Customizer\Settings\ImageSetting;
use Kontentblocks\Fields\Definitions\ReturnObjects\ImageReturn;
use Kontentblocks\Fields\Field;
use Kontentblocks\Utils\AttachmentHandler;
use Symfony\Component\HttpFoundation\Request;
use WP_Customize_Media_Control;

/**
 * Single image insert/upload.
 * @return array attachment id, title, caption
 *
 */
class Image extends Field
{

    public static $settings = array(
        'type' => 'image',
        'returnObj' => 'ImageReturn'
    );

    public static function init()
    {
        // handle minDimensions Settings
        add_filter('wp_handle_upload_prefilter', array(__CLASS__, 'uploadFilter'));
    }

    public static function uploadFilter($file)
    {

        $dimensions = filter_input(INPUT_POST, 'mindimension', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if (!is_array($dimensions) || count($dimensions) !== 2) {
            return $file;
        }

        $width = absint($dimensions[0]);
        $height = absint($dimensions[1]);

        if (!is_int($width) || !is_int($height)) {
            return $file;
        }

        $img = getimagesize($file['tmp_name']);
        $minimum = array('width' => $width, 'height' => $height);
        $width = $img[0];
        $height = $img[1];

        if ($width < $minimum['width']) {
            return array("error" => "Image dimensions are too small. Minimum width is {$minimum['width']}px. Uploaded image width is $width px");
        } elseif ($height < $minimum['height']) {
            return array("error" => "Image dimensions are too small. Minimum height is {$minimum['height']}px. Uploaded image height is $height px");
        } else {
            return $file;
        }
    }


    /**
     * Before the data is injected into the field/form twig template
     * Used to further manipulate or extend the data for the form
     * @param array $data
     * @return array
     */
    public function prepareTemplateData($data)
    {

        $image = new ImageReturn($this->value, $this, null);
        if (isset($data['value']['crop']) && !is_array($data['value']['crop'])) {
            $int = absint($data['value']['crop']);
            $image->crop(self::getCropValue($int));
        }

        $data['cropOptions'] = $this->getCropSelectNode();
        $data['image'] = $image;
        return $data;
    }

    /**
     * @param $int
     * @return mixed
     */
    public static function getCropValue($int)
    {
        $values = array(
            1 => array('left', 'top'),
            2 => array('center', 'top'),
            3 => array('right', 'top'),
            4 => array('left', 'center'),
            5 => array('center', 'center'),
            6 => array('right', 'center'),
            7 => array('left', 'bottom'),
            8 => array('center', 'bottom'),
            9 => array('right', 'bottom')
        );

        $int = absint($int);
        if (isset($values[$int])) {
            return $values[$int];
        }
        return $values[5];
    }

    /**
     * @return array
     */
    private function getCropSelectNode()
    {

        $current = $this->getValue('crop', 5);


        $options = array(
            array(
                'value' => 1,
                'name' => 'Left | Top',
                'selected' => selected('1', $current, false)
            ),
            array(
                'value' => 2,
                'name' => 'Center | Top',
                'selected' => selected('2', $current, false)
            ),
            array(
                'value' => 3,
                'name' => 'Right | Top',
                'selected' => selected('3', $current, false)
            ),
            array(
                'value' => 4,
                'name' => 'Left | Center',
                'selected' => selected('4', $current, false)
            ),
            array(
                'value' => 5,
                'name' => 'Center | Center',
                'selected' => selected('5', $current, false)
            ),
            array(
                'value' => 6,
                'name' => 'Right | Center',
                'selected' => selected('6', $current, false)
            ),
            array(
                'value' => 7,
                'name' => 'Left | Bottom',
                'selected' => selected('7', $current, false)
            ),
            array(
                'value' => 8,
                'name' => 'Center | Bottom',
                'selected' => selected('8', $current, false)
            ),
            array(
                'value' => 9,
                'name' => 'Right | Bottom',
                'selected' => selected('9', $current, false)
            ),
        );

        return $options;

    }

    /**
     * @param $val
     *
     * @return mixed
     */
    public function prepareFormValue($val)
    {

        if (isset($val['id']) && !is_numeric($val['id'])) {
            $val = null;
        }

        if (empty($val)) {
            return array(
                'id' => null,
                'caption' => '',
                'title' => '',
                'crop' => 5
            );
        }

        return $val;

    }

    /**
     * Fields saving method
     *
     * @param mixed $new
     * @param mixed $old
     * @return mixed
     *
     */
    public function save($new, $old)
    {
        if (is_null($new)) {
            return null;
        }

//        $caption = (isset($new['caption']) && !empty($new['caption'])) ? $new['caption'] : '';
//        $title = (isset($new['title']) && !empty($new['title'])) ? $new['title'] : '';
//
//        if (isset($new['id']) && !empty($new['id'])) {
//            wp_update_post(
//                array(
//                    'ID' => absint($new['id']),
//                    'post_excerpt' => $caption,
//                    'post_title' => $title
//                )
//            );
//        }
        return $new;
    }

    /**
     * @param \WP_Customize_Manager $customizeManager
     * @return null
     */
    public function addCustomizerControl(\WP_Customize_Manager $customizeManager, CustomizerIntegration $integration)
    {
        $customizeManager->add_control(
            new WP_Customize_Media_Control(
                $customizeManager, $integration->getSettingName($this),
                array(
                    'label' => $this->getArg('label'),
                    'section' => $this->section->getSectionId(),
                    'type' => $this->type
                )
            )
        );
    }

    /**
     * @param \WP_Customize_Manager $customizeManager
     * @param CustomizerIntegration $integration
     */
    public function addCustomizerSetting(\WP_Customize_Manager $customizeManager, CustomizerIntegration $integration)
    {
        $customizeManager->add_setting(
            new ImageSetting($customizeManager, $integration->getSettingName($this), array(
                'default' => $this->getArg('std'),
                'type' => 'theme_mod',
                'field' => $this
            ))
        );
    }


}