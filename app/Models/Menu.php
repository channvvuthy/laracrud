<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $table = "menus";
    /**
     * @var string
     */
    public string $moduleName = "Menu";

    /**
     * @var array|string[]
     */
    public array $detail = ['id', 'icon', 'name', 'created_at', 'updated_at'];

    protected $fillable = [
        "icon", "name", "action", "parent_id", "order"
    ];

    /**
     * Get the childrend of the menu item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrend()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
