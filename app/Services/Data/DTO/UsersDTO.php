<?php

namespace app\Services\Data\DTO;

class UsersDTO
{
    private string $name;
    private string $status;
    private string $category;
    private string $birthday;
    private string $phone;
    private string $email;
    private string $city;
    private string $communicate;

    public function __construct(array $entry)
    {
        $this->category = $entry[0] ?? '';
        $this->status = $entry[1] ?? '';
        $this->name = $entry[2] ?? '';
        $this->birthday = $entry[3] ?? '';
        $this->phone = $entry[4] ?? '';
        $this->email = $entry[5] ?? '';
        $this->city = $entry[6] ?? '';
        $this->communicate = $entry[7] ?? '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCommunicate(): string
    {
        return $this->communicate;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAll():array
    {
        return [
            $this->category,
            $this->status,
            $this->name,
            $this->birthday,
            $this->phone,
            $this->email,
            $this->city,
            $this->communicate
        ];
    }

    /**
     * @param string $communicate
     */
    public function setCommunicate(string $communicate): void
    {
        $this->communicate = $communicate;
    }

}
