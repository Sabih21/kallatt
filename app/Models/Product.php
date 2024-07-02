<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'qty',
        'featured',
        'recent',
        'keywords',
        'discount_price',
        'color',
        'thumb',
        'image_path',
        'company_id',
        'categoryID'
    ];

    // Relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'categoryID',);
    }

 // Inside the Product model

public function images()
{
    return $this->hasMany(ProductImage::class);
}

}
