<?php
function searchCategory($categories, $id)
{
    if (
        !empty($categories)
        && is_array($categories)
        && $id
    ) {
        $result = '';
        $not_isset_category_id_text = 'Категория с id: ' . $id . ' не найдена';

        foreach ($categories as $sub_array) {
            if (
                !empty($sub_array['id'])
                && $sub_array['id'] == $id
            ) {
                return !empty($sub_array['title']) ? $sub_array['title'] : 'У категории нет названия';
            } elseif (!empty($sub_array['children'])) {
                $result = searchCategory($sub_array['children'], $id);
                if (
                    $result
                    && $result != $not_isset_category_id_text
                ) {

                    return $result;
                }
            }
        }

        return $result ? $result : $not_isset_category_id_text;
    } else {
        throw new Exception('Неправильный формат входных данных!');
    }
}
