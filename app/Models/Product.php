<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    static function checkSlug($slug)
    {
        return self::where('slug', $slug)
            ->count();
    }

    static function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->orderBy('product.id', 'desc')
            ->get();
    }

    static function getActiveProduct()
    {
        return self::select('product.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->where('product.status', 0)
            ->orderBy('product.id', 'desc')
            ->get();
    }
}
