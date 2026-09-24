<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'categoria';

    protected $fillable = ['nombre', 'descripcion'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria', 'categoria');
    }
}
