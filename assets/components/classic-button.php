<?php 

printf('<%1$s %2$s>', $button_tag, $attributes_str); 

if (!empty($icon) && 'left' === $icon_align) : ?>
    <span class="button-icon"><i class="<?php echo esc_attr($icon); ?>"></i></span>
<?php 
endif;

if (!empty($text)) : ?>
    <span class="button-text"><?php echo esc_html($text); ?></span>
<?php
endif; 

if (!empty($icon) && 'right' === $icon_align) : ?>
    <span class="button-icon"><i class="<?php echo esc_attr($icon); ?>"></i></span>
<?php endif; 

printf('</%1$s>', $button_tag);