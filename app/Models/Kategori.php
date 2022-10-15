<?php

namespace App\Models;

use App\Models\Resep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function reseps()
    {
        return $this->hasMany(Resep::class); //One To Many
    }
    
}
