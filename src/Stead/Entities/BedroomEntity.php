<?php
namespace App\Stead\Entities;

use DateTime;

class BedroomEntity
{
    public  $id;
    public  $name;
    public  $description;
    public  $type;
    public   $statut;
    public $price;
    public $image;
    public $occupiedOn;
    public  $releasedOn;
    public  $categoryId;

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
        return  '/images/rooms/'.$filename.'_thumb.'. $extension;
    }
    public function getImageUrl(): string
    {
        return '/images/rooms/' . $this->image;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}