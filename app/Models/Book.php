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
        'category_id',
        'judul',
        'penulis_id',
        'penerbit_id',
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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function read_histories()
    {
        return $this->hasMany(BookReadHistory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'penerbit_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'penulis_id', 'id');
    }
}
