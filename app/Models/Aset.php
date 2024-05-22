<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function getImageAttribute($value)
    {
        if ($value && file_exists(public_path('assets/img/aset/' . $value))) {
            return asset('assets/img/aset/' . $value);
        } else {
            return asset('assets/img/default.jpg');
        }
    }
}
