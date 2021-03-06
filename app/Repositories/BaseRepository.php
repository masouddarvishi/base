<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected function applyParams(&$builder, $params)
    {
        if (! empty($params['with'])) {
            $builder->with($params['with']);
        }

        if (! empty($params['per_page'])) {
            $builder->paginate($params['per_page']);
        }
    }
}
