<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementUserAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(PlaceQuestion::class, 'place_question_id');
    }

    public function choice()
    {
        return $this->belongsTo(PlaceChoice::class, 'place_choice_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
}
