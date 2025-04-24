<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $menuItems
 * @property-read int|null $menu_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_options')
            ->withPivot('price_adjustment')
            ->withTimestamps();
    }
}
