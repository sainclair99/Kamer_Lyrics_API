<?php

namespace App\Models;

use App\Models\User;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $titre
 * @property string $image
 * @property string $contenu
 * @property string $date_publication
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDatePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @property-read Genre|null $genre
 * @property-read User|null $user
 * @property int $genre_id
 * @property int $editor_id
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereGenreId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'titre',
        'image',
        'contenu',
        'date_publication',
        'genre_id',
        'editor_id'
    ];

    public function genre() : BelongsTo {
        return $this->belongsTo(Genre::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
