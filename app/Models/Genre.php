<?php

namespace App\Models;

use App\Models\Lyrics;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Lyrics> $lyrics
 * @property-read int|null $lyrics_count
 * @mixin \Eloquent
 */
class Genre extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'label'
    ];

    // * One to Many relationship
    public function articles() : HasMany {
        return $this->hasMany(Article::class);
    }

    // * Many to Many relationship
    public function lyrics() : BelongsToMany {
        return $this->belongsToMany(Lyrics::class);
    }

    // * scope functions
    public function scopeWithArticles(Builder $query){
        $query->with('articles');
    }

    public function scopeWithLyrics(Builder $query){
        $query->with('lyrics');
    }
}
