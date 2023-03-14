<?php

namespace App\Models;

use App\Models\Plante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    public function plants(){
        return $this->hasMany(Plante::class);
    }
}
