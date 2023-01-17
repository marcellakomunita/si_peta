<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'binary';
    public $incrementing = false;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isbn',
        'judul',
        'penulis',
        'penerbit',
        'tgl_terbit',
        'sinopsis',
        'img_cover',
        'file_ebook'
    ];

    protected $casts = [
        'tgl_terbit' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::random(16);
        });
    }

    public function getKeyType()
    {
        return 'char';
    }

}
