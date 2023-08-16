<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $libelle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read User|null $user
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUserId($value)
 * @mixin \Eloquent
 */
class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libelle',
    ];

    public function messages() : HasMany {
        return $this->hasMany(Message::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    // * Many to Many relationship
    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class);
    }
}
