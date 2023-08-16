<?php

namespace App\Models;

use App\Models\User;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Comment;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Lyrics
 *
 * @property int $id
 * @property string $titre
 * @property string $status
 * @property int $verifier
 * @property string $contenu
 * @property string $date_sortie
 * @property string $video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereDateSortie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereVerifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereVideo($value)
 * @property-read Album|null $album
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Genre> $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Language> $languages
 * @property-read int|null $languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Translation> $translations
 * @property-read int|null $translations_count
 * @property-read User|null $user
 * @property int $album_id
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $favorites
 * @property-read int|null $favorites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $likes
 * @property-read int|null $likes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lyrics whereUserId($value)
 * @mixin \Eloquent
 */
class Lyrics extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'status',
        'verifier',
        'titre',
        'contenu',
        'date_sortie',
        'video',
        'album_id',
    ];

    // * One to Many relationship
    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function album() : BelongsTo {
        return $this->belongsTo(Album::class);
    }

    public function translations() : HasMany {
        return $this->hasMany(Translation::class);
    }

    // * Many to Many relationship
    public function genres() : BelongsToMany {
        return $this->belongsToMany(Genre::class);
    }

    public function languages() : BelongsToMany {
        return $this->belongsToMany(Language::class);
    }

    public function likes() : BelongsToMany {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function favorites() : BelongsToMany {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function authors() : BelongsToMany {
        return $this->belongsToMany(Artist::class, 'authors');
    }

    // * Scope functions
    public function scopeVerified(Builder $query){
        $query->where('verifier', 1);
    }

    // public function scopeWithTwoLike(Builder $query){
    //     $query->where(, '>=', 2);
    // } 
}
