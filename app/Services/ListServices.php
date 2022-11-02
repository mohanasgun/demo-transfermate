<?php

namespace App\Services;

use App\Models\Author;

class ListServices
{
    /**
     * fetch data of authors and books
     *
     * @param array $params
     * @return array
     */
    public function listData($params)
    {
        return Author::with('books:author_id,id,name')->when(!empty($params['input']), function ($query) use ($params) {
            return $query->where('name', 'ilike', "%$params[input]%");
        })->select('id', 'name')->get();
    }
}
