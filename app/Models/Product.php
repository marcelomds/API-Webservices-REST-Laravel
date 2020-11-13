<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['category_id', 'name', 'description', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param array $data
     * @param int $total
     * @return mixed
     */
    public function getResults(array $data, int $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['description']))
            return $this->orderBy('id', 'DESC')->paginate($total);

        return $this->where(function ($query) use ($data) {
            if (isset($data['filter'])) {
                $filter = $data['filter'];
                $query->where('name', $filter);
                $query->orWhere('description', 'LIKE', "%{$filter}%");
            }

            if (isset($data['name']))
                $query->where('name', $data['name']);

            if (isset($data['description'])) {
                $description = $data['description'];
                $query->where('description', 'LIKE', "%{$description}%");
            }
        })
            ->orderBy('id', 'DESC')
            ->paginate($total);
    }
}

