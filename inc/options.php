<?php
//Theme options
$odin_theme_options = new Odin_Theme_Options(
    'tpb-options', // Slug/ID
    __( 'The Pirate Bay Theme Options', 'odin' ), // title
    'manage_options' // Permission
);
$odin_theme_options->set_tabs(
    array(
        array(
            'id' => 'tpb-social', // Tab ID
            'title' => __( 'Social', 'odin' ), // Tab title
        ),
    )
);
$odin_theme_options->set_fields(
    array(
        'social-section' => array(
            'tab'   => 'tpb-social', // Session
            'title' => '',
            'fields' => array(
                array(
                    'id' => 'facebook',
                    'label' => __( 'Facebook URL', 'odin' ),
                    'type' => 'text',
                    'description' => __( 'Paste your facebook URL here', 'odin' )
                ),
                array(
                    'id' => 'twitter',
                    'label' => __( 'Twitter URL', 'odin' ),
                    'type' => 'text',
                    'description' => __( 'Paste your twitter URL here', 'odin' )
                ),
            )
        ),
    )
);
?>
