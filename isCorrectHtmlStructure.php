<?php
function isCorrectHtmlStructure($tags)
{
    if (is_array($tags)) {
        $exception = [
            '<meta>',
            '<img>',
            '<link>',
            '<br>',
            '<hr>',
            '<input>',
            '<area>',
            '<param>',
            '<col>',
            '<base>'
        ];
        $open_tags = [];

        foreach ($tags as $tag) {
            if (in_array($tag, $exception)) {
                continue;
            } elseif (strpos($tag, '</') === false) {
                $open_tags[] = $tag;
            } else {
                if (array_pop($open_tags) != str_replace('/', '', $tag)) {

                    return false;
                }
            }
        }

        return empty($open_tags) ? true : false;
    } else {
        throw new Exception('Функция ожидает принять массив в качестве аргумента');
    }
}
