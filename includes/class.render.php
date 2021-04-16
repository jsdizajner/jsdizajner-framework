<?php
defined('ABSPATH') || exit;


class Render
{
    private $docPage;
    private $docBook;

    /**
     * Creates a link to Documentation about error
     *
     * @return HTML Error link to documentation
     */

    private function create_link()
    {
        $link =  JSD_Config::$info['docs'] . '/books/' . strtolower($this->docBook) . '/page/' . str_replace("_", "-", $this->docPage);
        $error = '<a href="' . $link . '" target="_blank"><small>Error #</small></a>';
        return $error;
    }


    /**
     * This functions handles all the rendering of data to Front-End
     * It checks for errors or passes the function that was called from
     *
     * @param [var] $functionName Pass the variable that would be returned
     * @param [mixed] $type Available option: false / 'empty' / 'null' 
     * @param [string] $id Error ID
     * @return void Error or $functionName
     */

    public function handler($functionName, $type, $params, $id, $message)
    {

        // Check Method & Class name for documentation link
        $documentation = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 0);
        $this->docPage = $documentation[1]['function'];
        $this->docBook = $documentation[1]['class'];

        switch ($type) {

                // Boolean Render Handler
            case (false):

                if ($functionName === $type) :
                    return print_r($this->create_link() . ' <code> <span class="green">' . $id . '</span> ' . $message . '</code> <br>');
                else :
                    return $functionName;
                endif;

                break;

                // Empty String Handler
            case ('empty'):

                $message = $this->message;
                return print_r($message[$id]);

                break;

                // Array Handler
            case ('params'):

                if (empty($params[0]) || empty($params[1])) :
                    return print_r($this->create_link() . ' <code> <span class="green">' . $id . '</span> ' . $message . '</code> <br>');
                else :
                    return print_r($functionName);
                endif;

                break;

                // Button Handler
            case ('button'):

                $args = $functionName;
                if (empty($args)) {
                    return print_r($this->create_link() . ' <code> <span class="green">' . $id . '</span> ' . $message . '</code> <br>');
                } else {
                    extract($args);

                    $button_attrs = [];
                    $button_classes   = [$class];
                    $button_classes[] = 'style-' . $style;
                    $button_classes[] = 'tm-button-' . $size;

                    if (!empty($extra_class)) {
                        $button_classes[] = $extra_class;
                    }

                    if (!empty($icon)) {
                        $button_classes[] = 'icon-' . $icon_align;
                    }

                    $button_attrs['class'] = implode(' ', $button_classes);

                    if (!empty($id)) {
                        $button_attrs['id'] = $id;
                    }

                    $button_tag = 'div';

                    if (!empty($link['url'])) {
                        $button_tag = 'a';

                        $button_attrs['href'] = $link['url'];

                        if (!empty($link['is_external'])) {
                            $button_attrs['target'] = $link['_blank'];
                        }

                        if (!empty($link['nofollow'])) {
                            $button_attrs['rel'] = $link['nofollow'];
                        }
                    }

                    $attributes_str = '';

                    if (!empty($button_attrs)) {
                        foreach ($button_attrs as $attribute => $value) {
                            $attributes_str .= ' ' . $attribute . '="' . esc_attr($value) . '"';
                        }
                    }

                    // Support for Wrapper Class
                    if (!empty($wrapper_class)) {
                        include(PLUGIN_DIR . 'assets/components/wrapper-button.php');
                    } else {
                        include(PLUGIN_DIR . 'assets/components/classic-button.php');
                    }
                }

                break;
        }
    }
}
