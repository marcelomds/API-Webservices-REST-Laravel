<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * @param null $name
     * @return mixed
     */
    public function getResults($name = null)
    {
        if (!$name)
            return $this->get();

       return $this->where('name', 'LIKE', "%{$name}%")->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
