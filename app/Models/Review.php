<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Review extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['helpful', 'rating', 'description', 'advantages', 'disadvantages', 'photos_path', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRatingsCount($query, $productId)
    {
        return $query->where('product_id', $productId)
            ->select('rating', DB::raw('COUNT(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->pluck('count', 'rating');
    }
}
