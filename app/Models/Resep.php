<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;

class Resep extends Model
{
    use HasFactory, Sluggable;
    public $primaryKey = 'id';
    
    protected $fillable = [
            'judul_resep','kategori_id','slug', 'gambar','deskripsi', 'resepnya'
        ]; 
        
        static function getResep(){
            $return=DB::table('reseps');
            // ->join('reseps','kategori_id', '=', 'kategoris.id');
            return $return;
        }
        
        
        protected $guarded = ['id'];
        protected $with = ['kategori', 'chef'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_resep'
            ]
        ];
    } 


    public function scopeFilter($query, array $filters)
    {
        // callback
        $query->when($filters['cari'] ?? false, function($query, $cari){
            return $query->where('judul_resep', 'like', '%' . $cari . '%')
                         ->orWhere('resepnya', 'like', '%' . $cari . '%');
        });

        $query->when($filters['kategori'] ?? false, function($query, $kategori){
            return $query->whereHas('kategori', function($query) use ($kategori){
                $query->where('slug', $kategori);
            });
        });

        // arrow function
        $query->when($filters['chef'] ?? false, fn($query, $chef)=>
            $query->whereHas('chef', fn($query) => 
                $query->where('username', $chef)
            )
        );
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function chef()
    {
        return $this->belongsTo(User::class, 'user_id'); //One to many
    }

    public function getRouteKeyname()
    {
        return 'slug';
    }
}
 