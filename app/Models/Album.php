<?php

namespace App\Models;

use App\Models\Artist;
use App\Models\Lyrics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property string $libelle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Lyrics> $lyrics
 * @property-read int|null $lyrics_count
 * @mixin \Eloquent
 */
class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'artist_id'
    ];

    public function lyrics() : HasMany {
        return $this->hasMany(Lyrics::class);
    }

    Public function artist() : BelongsTo {
        return $this.belongsTo(Artist::class);
    }
}
