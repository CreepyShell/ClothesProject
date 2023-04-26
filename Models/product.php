<?php

declare(strict_types=1);
class Product
{
    public int $id;
    public string $name;
    public string $description;
    public float $cost;
    public string $image_url;
    public int $type_id;
    public int $amount;

    //https://www.amitmerchant.com/multiple-constructors-php/
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    function __construct6(string $name, string $description, float $cost, string $image_url, int $type_id, int $amount)
    {
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->image_url = $image_url;
        $this->type_id = $type_id;
        $this->amount = $amount;
    }

    function __construct7(int $id, string $name, string $description, float $cost, string $image_url, int $type_id, int $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->image_url = $image_url;
        $this->type_id = $type_id;
        $this->amount = $amount;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }
    function getCost()
    {
        return $this->cost;
    }
    function getTypeId()
    {
        return $this->type_id;
    }
    function getDescription()
    {
        return $this->description;
    }
    function getImage()
    {
        return $this->image_url;
    }

    function getAmount()
    {
        return $this->amount;
    }

    function setName(string $newName)
    {
        $this->name = $newName;
    }
    function setCost(float $cost)
    {
        $this->cost = $cost;
    }
    function setDescription(string $description)
    {
        $this->description = $description;
    }
    function setImage(string $image_url)
    {
        $this->image_url = $image_url;
    }
}
