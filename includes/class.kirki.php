<?php
defined('ABSPATH') || exit;

/**
 * Adding Theme Customizer Options Panel
 */

Kirki::add_panel('themeCustomization', array(
    'priority'    => 10,
    'title'       => esc_html__('Theme Options', THEME_TEXT_DOMAIN),
    'description' => esc_html__('Edit contents and CTA blocks on JSD Theme', THEME_TEXT_DOMAIN),
));

/**
 * Creating Section
 */

Kirki::add_section('homepage', array(
    'title'          => esc_html__('Homepage', THEME_TEXT_DOMAIN),
    'description'    => esc_html__('In this section you are editing content in Homepage', THEME_TEXT_DOMAIN),
    'panel'          => 'themeCustomization',
    'priority'       => 160,
));

Kirki::add_field('welcomeText', [
    'type'     => 'textarea',
    'settings' => 'welcomeText_setting',
    'label'    => esc_html__('Welcome Text Subheadline', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('I am a digital graphic designer who designs digital products and web solutions.', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);

Kirki::add_field('aboutMeTitle', [
    'type'     => 'text',
    'settings' => 'aboutMeTitle_setting',
    'label'    => esc_html__('Title for About Me Section', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('Add Title in Customizer', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);

Kirki::add_field('aboutMeDesc', [
    'type'     => 'textarea',
    'settings' => 'aboutMeDesc_setting',
    'label'    => esc_html__('Bigger Intro Paragraph', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('Add Intro in Customizer', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);

Kirki::add_field('aboutMeDescSmall', [
    'type'     => 'textarea',
    'settings' => 'aboutMeDescSmall_setting',
    'label'    => esc_html__('Small Intro Paragraph', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('Add Paragraph in Customizer', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);

Kirki::add_field('portfolioTitle', [
    'type'     => 'text',
    'settings' => 'portfolioTitle_setting',
    'label'    => esc_html__('Title for Portfolio Section', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('Add Title in Customizer', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);

Kirki::add_field('portfolioDesc', [
    'type'     => 'textarea',
    'settings' => 'portfolioDesc_setting',
    'label'    => esc_html__('Subheadline', THEME_TEXT_DOMAIN),
    'section'  => 'homepage',
    'default'  => esc_html__('', THEME_TEXT_DOMAIN),
    'priority' => 10,
]);
