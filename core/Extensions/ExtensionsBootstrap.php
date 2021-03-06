<?php

namespace Kontentblocks\Extensions;

/**
 * Bootstrap, only if theme supports this feature
 */
if (current_theme_supports( 'kontentblocks:page-settings' )) {
    add_action( 'kb.init', array( '\Kontentblocks\Extensions\PageSettingsUI', 'init' ) );
}

if (current_theme_supports( 'kb.backups.ui' )) {
    add_action(
        'init',
        function () {
            $support = get_theme_support( 'kb.backups.ui' );
            if (is_array( $support )) {
                foreach ($support as $postType) {
                    add_post_type_support( $postType, 'kb.backups.ui' );
                }
            }
            new BackupInspect();
        }
    );
}


if (current_theme_supports( 'kontentblocks.layouts' )) {
    add_action(
        'kb.init',
        function () {
            $support = get_theme_support( 'kontentblocks.layouts' );
            if (is_array( $support ) && is_array($types = array_shift($support))) {
                foreach ($types as $postType) {
                    add_post_type_support( $postType, 'kontentblocks.layouts' );
                }
            }
            new LayoutConfigurations();
        }
    );
}

//new SidebarSelector();
include_once 'OSAdminBar.php';