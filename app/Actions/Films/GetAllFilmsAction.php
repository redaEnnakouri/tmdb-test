<?php

namespace App\Actions\Films;

use App\Models\Film;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllFilmsAction
{


    /**
     * @param array $attributes
     * @return LengthAwarePaginator
     */
    public static function execute(array $attributes): LengthAwarePaginator
    {
        return Film::query()
            ->when(isset($attributes['search']), function ($query) use ($attributes) {
                $query->where(function ($query) use ($attributes) {
                    $query->where('title', 'like', '%' . $attributes['search'] . '%')
                        ->orWhere('original_title', 'like', '%' . $attributes['search'] . '%')
                        ->orWhere('overview', 'like', '%' . $attributes['search'] . '%')
                        ->orWhereRelation('filmDetail', 'tagline', 'like', '%' . $attributes['search'] . '%');
                });
            })
            ->isActive()
            ->paginate();
    }
}
