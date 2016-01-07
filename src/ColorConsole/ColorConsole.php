<?php namespace JasonChang\ColorConsole;

/**
 * Class ColorConsole
 *
 *
 * Created by PhpStorm.
 * User: Jason Chang chaoyue.chang@qq.com
 * Date: 2016/1/7
 * Time: 17:59
 *
 * @package JasonChang\ColorConsole
 */

use Exception;

class ColorConsole
{
    /**
     * 控制台文字样式控制码
     * Console font sytle control codes
     *
     * @var array
     */
    static $styles = [
        'none' => '0',
        'bold' => '1',
        'dark' => '2',
        'italic' => '3',
        'underline' => '4',
        'blink' => '5',
        'reverse' => '7',
        'concealed' => '8'
    ];

    /**
     * 控制台文字颜色控制码
     * Console font foreground color control codes
     *
     * @var array
     */
    static $foreground = [
        'default' => '39',
        'black' => '30',
        'red' => '31',
        'green' => '32',
        'yellow' => '33',
        'blue' => '34',
        'magenta' => '35',
        'cyan' => '36',
        'light_gray' => '37',
        'dark_gray' => '90',
        'light_red' => '91',
        'light_green' => '92',
        'light_yellow' => '93',
        'light_blue' => '94',
        'light_magenta' => '95',
        'light_cyan' => '96',
        'white' => '97',
    ];

    /**
     * 控制台北京颜色控制码
     * Console font background color control codes
     *
     * @var array
     */
    static $background = [
        'bg_default' => '49',
        'bg_black' => '40',
        'bg_red' => '41',
        'bg_green' => '42',
        'bg_yellow' => '43',
        'bg_blue' => '44',
        'bg_magenta' => '45',
        'bg_cyan' => '46',
        'bg_light_gray' => '47',
        'bg_dark_gray' => '100',
        'bg_light_red' => '101',
        'bg_light_green' => '102',
        'bg_light_yellow' => '103',
        'bg_light_blue' => '104',
        'bg_light_magenta' => '105',
        'bg_light_cyan' => '106',
        'bg_white' => '107',
    ];

    /**
     * 返回染色后的字符串
     * Returns colored string
     *
     * @param $string
     * @param null $foreground
     * @param null $background
     * @param null $style
     * @return string
     */
    public static function color($string, $foreground = null, $background = null, $style = null)
    {
        if($foreground && !array_key_exists($foreground, static::$foreground))
            throw new Exception('Foreground color isn\'t exists!');

        if($background && !array_key_exists($background, static::$background))
            throw new Exception('Background color isn\'t exists!');

        if(is_string($style) && !array_key_exists($style, static::$style))
            throw new Exception('Style isn\'t exists!');

        if($string == '' | $string == "\n" | $string == "\r\n")
            return '';

        $codes = [];

        if(is_array($style)) {
            foreach($style as $item){
                if(!array_key_exists($item, static::$style))
                    throw new Exception('Style isn\'t exists!');

                $codes[] = static::$style[$item];
            }
        } else if(!is_null($style)) {
            $codes[] = $style;
        }

        if(!is_null($foreground))
            $codes[] = static::$foreground[$foreground];

        if(!is_null($background))
            $codes[] = static::$background[$background];

        $head = "\033[" . join(';', $codes) . 'm';
        $footer = "\033[0m";

        return $head . $string . $footer;
    }
}