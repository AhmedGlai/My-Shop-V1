<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     * @Assert\Range(min=5500,max=90000)
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=10,max=4000)
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $options;
    public function __construct()
    {
        $this->options=new ArrayCollection();
    }

    /**
     * @return int
    */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     *
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface)
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }


}