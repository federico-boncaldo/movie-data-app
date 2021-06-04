<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'year', 'imdb_id', 'type'];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function storePoster(array $result)
    {
        if ($result['Poster'] != 'N/A') {
            $poster = Poster::where('url', $result['Poster'])->get();

            if ($poster->isNotEmpty()) {
                $poster = $poster->first();
            } else {
                $poster = new Poster();
                $poster->url = $result['Poster'];
                $poster->save();
            }
            $this->poster()->associate($poster);
            $this->save();
        }
    }
}
