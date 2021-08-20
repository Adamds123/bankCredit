<?php

namespace App\Stead\Entities;


class EatyEntity
{
    public  $id;
    public $price;
    public  $description;
    public $occupiedOn;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public $image;

    /**
     * @return mixed
     */
    final public function getThumb(): string
    {
        ['filename'=> $filename, 'extension' => $extension] = pathinfo($this->image);
        return  '/images/menu/'.$filename.'_thumb.'. $extension;
    }
    public function getImageUrl(): string
    {
        return '/images/menu/' . $this->image;
    }

    /**
     * @return mixed
     */
    public function getOccupiedOn(): \DateTime
    {
        return $this->occupiedOn;
    }

    /**
     * @param mixed $occupiedOn
     */
    public function setOccupiedOn($occupiedOn): void
    {
        $this->occupiedOn = $occupiedOn;
    }
}