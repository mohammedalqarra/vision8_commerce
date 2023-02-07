<?php

namespace App\Traits;

// use Illuminate\Database\Eloquent\Casts\Attribute;
// $json = json_decode($this->name, true);

trait Trans

{

    // protected function nameAr(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => json_decode($this->name, true)['ar'],
    //     );
    // }


    public function getTransNameAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)[app()->currentLocale()];
        }
        return $this->name;
    }

    public function getNameEnAttribute() // أسم النهائي
    {
        if ($this->name) {

            return json_decode($this->name, true)['en'];

        }
        return $this->name;
    }
    public function getNameArAttribute()
    {
        if ($this->name) {

            return json_decode($this->name, true)['ar'];

        }
        return $this->name;
    }

    public function getTransContentAttribute()
    {
        if ($this->content) {
            return json_decode($this->content, true)[app()->currentLocale()];
        }
        return $this->name;
    }
    public function getContentEnAttribute() // أسم النهائي
    {
        if ($this->content) {
            return json_decode($this->content, true)['en'];
        }
        return $this->content;
    }
    public function getContentArAttribute()
    {
        if ($this->content) {
            return json_decode($this->content, true)['ar'];
        }
        return $this->content;
    }
}
