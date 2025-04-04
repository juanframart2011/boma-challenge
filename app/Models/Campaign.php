<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'image', 'url', 'active', 'created_by', 'fecha', 'presupuesto'];

    protected $appends = ['image_url'];

    // ✅ Accessor para `image_url`
    public function getImageUrlAttribute()
    {
        // Si la imagen está guardada en el almacenamiento local de Laravel
        if ($this->image) {
            return asset($this->image); // Devuelve la URL completa de la imagen
        }
        return asset('img/campaign/default.jpg'); // Imagen por defecto
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}