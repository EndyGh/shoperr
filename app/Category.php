<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name','slug','active','description'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }


    public function generatePath()
    {
        $slug = $this->slug;

        $this->path = $this->isRoot() ? $slug : $this->parent->path.'/'.$slug;

        return $this;
    }

    // Get url
    public function getUrl()
    {
        return '/catalog/'.$this->path;
    }

    public function updateDescendantsPaths()
    {
        // Получаем всех потомков в древовидном порядке
        $descendants = $this->descendants()->defaultOrder()->get();

        // Данный метод заполняет отношения parent и children
        $descendants->push($this)->linkNodes()->pop();

        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }

    /**
     * Set the slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

}
