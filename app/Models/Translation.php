<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lyrics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Translation
 *
 * @property int $id
 * @property string $contenu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereUpdatedAt($value)
 * @property-read Lyrics|null $lyrics
 * @property-read User|null $user
 * @property int $user_id
 * @property int $lyrics_id
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLyricsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereUserId($value)
 * @mixin \Eloquent
 */
class Translation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'contenu',
        'lyrics_id',
        'user_id'
    ];

    public function lyrics() : BelongsTo {
        return $this->belongsTo(Lyrics::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
