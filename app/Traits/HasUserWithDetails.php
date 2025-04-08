<?php

namespace App\Traits;

trait HasUserWithDetails
{
    public function userWithDetailsScope()
    {
        return function ($query) {
            $query->select('id', 'user_image')
                ->with([
                    'personal_details' => function ($q) {
                        $q->select('user_id', 'first_name', 'last_name', 'specialist');
                    }
                ]);
        };
    }
}
