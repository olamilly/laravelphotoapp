<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Photo extends Model
{
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    use Searchable;
    public function toSearchableArray():array
    {
        return [
            'caption' => $this->caption
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    
}
