<?php

namespace Kontentblocks\Ajax\Actions;

use Kontentblocks\Ajax\AjaxActionInterface;
use Kontentblocks\Ajax\AjaxSuccessResponse;
use Kontentblocks\Modules\ModuleWorkshop;
use Kontentblocks\Utils\Utilities;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * Class UpdateModuleData
 *
 * Handle async data saving from backend edit screens for a single module
 *
 * @author Kai Jacobsen
 * @package Kontentblocks\Ajax\Frontend
 * @since 0.1.0
 */
class UpdateModuleData implements AjaxActionInterface
{
    static $nonce = 'kb-update';

    /**
     * Sends new module data as json formatted object
     *
     * @since 0.1.0
     * @param Request $request
     * @return AjaxSuccessResponse
     */
    public static function run(Request $request)
    {
        global $post;

        $moduleArgs = Utilities::validateBoolRecursive($request->get('module'));
        $data = wp_unslash($request->request->get('data')); // remove slashes from ajax
        $postId = $request->request->getInt('postId', null);

        // setup global post
        $post = get_post($postId);
        setup_postdata($post);

        $environment = Utilities::getPostEnvironment($postId);
        $workshop = new ModuleWorkshop($environment, $moduleArgs);
        $module = $workshop->getModule();

        $overrides = (isset($data['overrides'])) ? $data['overrides'] : array();

        $module->properties->parseOverrides($overrides);

         // gather data
        $old = $module->model->export();
        $new = $module->save($data, $old);
        $mergedData = Utilities::arrayMergeRecursive($new, $old);

        $mergedData = apply_filters('kb.module.modify.data', $mergedData, $module);
        $module->updateModuleData($mergedData);
        $module->model->sync(true);
        $module->properties->viewfile = (!empty($data['viewfile'])) ? $data['viewfile'] : '';

        $environment->getStorage()->reset();
        $environment->getStorage()->addToIndex($module->getId(), $module->properties->export());

        $return = array(
            'newModuleData' => $mergedData
        );
        Utilities::remoteConcatGet($postId);
        return new AjaxSuccessResponse('Module data updated.', $return);
    }

}