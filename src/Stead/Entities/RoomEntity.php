<?php

namespace App\Stead\Entities;

class RoomEntity
{
    public  $id;
    public  $description;
    public  $price;
    public $image;
    public $occupiedOn;
    public  $releasedOn;

    public function setOccupiedOn(mixed $datetime): void
    {
        if (is_string($datetime)) {
            $this->occupiedOn = new \DateTime($datetime);
        }
    }

    public function setReleasedOn( mixed $datetime): void
    {
        if (is_string($datetime)) {
            $this->releasedOn = new \DateTime($datetime);
        }
    }

    /**
     * @return mixed
     */
    final public function getThumb(): string
    {
        ['filename'=> $filename, 'extension' => $extension] = pathinfo($this->image);
        return  '/images/salles/'.$filename.'_thumb.'. $extension;
    }
    public function getImageUrl(): string
    {
        return '/images/salles/' . $this->image;
    }
}