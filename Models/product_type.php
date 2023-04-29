<?php

declare(strict_types=1);
class ProductType
{
    public int $id;
    public string $description;
    public string $category;

    function getId()
    {
        return $this->id;
    }
    function getDescription()
    {
        return $this->description;
    }
    function getCategory()
    {
        return $this->category;
    }

    function setId(int $id)
    {
        $this->id = $id;
    }
    function setDescription(string $description)
    {
        $this->description = $description;
    }
    function setCategory(string $category)
    {
        $this->category = $category;
    }
}
