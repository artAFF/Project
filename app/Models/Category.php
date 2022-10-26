<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /* protected $fillable = ['code', 'name', 'description']; */

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
        }
    

}
