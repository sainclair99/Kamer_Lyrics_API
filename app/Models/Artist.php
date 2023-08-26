<?php

namespace App\Models;

use App\Models\User;
use App\Models\Album;
use App\Models\Lyrics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Artist
 *
 * @property int $id
 * @property string $nom
 * @property string $genre_musical
 * @property array $reseaux_sociaux
 * @property string $biograhie
 * @property int $est_utilisateur
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereBiograhie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereEstUtilisateur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereGenreMusical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereReseauxSociaux($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereUpdatedAt($value)
 * @property-read \App\Models\User|null $alias
 * @mixin \Eloquent
 */
class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'genre_musical',
        'reseaux_sociaux',
        'biograhie',
        'est_utilisateur',
        'user_id'
    ];


    public function alias() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function lyrics() : BelongsToMany {
        return $this->belongsToMany(Lyrics::class, 'authors');
    }
    // * ------------
    public function followers() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
    public function albums() : HasMany {
        return $this->hasMany(Album::class);
    }
}
