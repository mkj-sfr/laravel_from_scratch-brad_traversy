<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters): void
    {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%'.$filters['tag'].'%');
        }
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%'.$filters['search'].'%')
            ->orWhere('description', 'like', '%'.$filters['search'].'%')
            ->orWhere('tags', 'like', '%'.$filters['search'].'%');
        }
    }
}
