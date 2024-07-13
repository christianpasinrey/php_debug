<?php

class User
{
    public $name;
    public $email;
    public $age;
    public $isStudent;
    public $address;
    public $hobbies;

    public function __construct(array $data)
    {
        $proccessedData = (object) $data;
        $this->name = $proccessedData->name;
        $this->email = $proccessedData->email;
        $this->age = $proccessedData->age;
        $this->isStudent = $proccessedData->isStudent;
        $this->address = $proccessedData->address;
        $this->hobbies = $proccessedData->hobbies;
    }

    public function __toString()
    {
        return "Name: $this->name, Email: $this->email";
    }

    public static function fromJson($json)
    {
        $data = json_decode($json);
        $user = new User(
            $data->name,
            $data->email,
            $data->age,
            $data->isStudent,
            $data->address,
            $data->hobbies,
        );
        return $user;
    }
}
