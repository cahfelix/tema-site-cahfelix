<?php

//define constants
define( 'RIVER_QODE', true );
define( 'QODE_ROOT', get_template_directory_uri() );
define( 'QODE_ROOT_DIR', get_template_directory() );
define( 'QODE_CSS_ROOT', QODE_ROOT . '/css' );
define( 'QODE_CSS_ROOT_DIR', QODE_ROOT_DIR . '/css' );
define( 'QODE_JS_ROOT', QODE_ROOT . '/js' );
define( 'QODE_JS_ROOT_DIR', QODE_ROOT_DIR . '/js' );
define( 'QODE_INCLUDES_ROOT', QODE_ROOT . '/includes' );
define( 'QODE_INCLUDES_ROOT_DIR', QODE_ROOT_DIR . '/includes' );
define( 'QODE_VAR_PREFIX', 'qode_' );

include_once QODE_INCLUDES_ROOT_DIR . '/modules/toolbar-hook.php';
include_once QODE_INCLUDES_ROOT_DIR . '/qode-plugin-helper-functions.php';
include_once QODE_INCLUDES_ROOT_DIR . '/qode-dynamic-helper-functions.php';
include_once QODE_INCLUDES_ROOT_DIR . '/qode-body-classes.php';
include_once QODE_INCLUDES_ROOT_DIR . '/qode-custom-sidebar.php';
include_once QODE_INCLUDES_ROOT_DIR . '/qode-menu.php';
include_once QODE_INCLUDES_ROOT_DIR . '/widgets/qode-flickr-widget.php';
include_once QODE_INCLUDES_ROOT_DIR . '/widgets/qode-latest-posts-menu.php';
include_once QODE_INCLUDES_ROOT_DIR . '/widgets/qode-relate-posts-widget.php';
include_once QODE_INCLUDES_ROOT_DIR . '/widgets/qode-call-to-action-widget.php';