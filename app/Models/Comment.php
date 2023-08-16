<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lyrics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $commentaire
 * @property string $date_commentaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDateCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @property-read Lyrics|null $Lyrics
 * @property-read User|null $user
 * @property int $user_id
 * @property int $lyrics_id
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereLyricsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentaire',
        'date_commentaire',
        'user_id',
        'lyrics_id'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function lyrics() : BelongsTo {
        return $this->belongsTo(Lyrics::class);
    }
}
