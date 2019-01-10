<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 30.12.2018
 * Time: 21:35
 */

class Role implements JsonSerializable
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }/**
 * @return mixed
 */
public function getId()
{
    return $this->id;
}/**
 * @param mixed $id
 */
public function setId($id): void
{
    $this->id = $id;
}/**
 * @return mixed
 */
public function getName()
{
    return $this->name;
}/**
 * @param mixed $name
 */
public function setName($name): void
{
    $this->name = $name;
}


}

