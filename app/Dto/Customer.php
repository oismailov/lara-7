<?php

namespace App\Dto;

/**
 * Class Customer
 *
 * @package App\Dto
 */
class Customer
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $tickets;

    /**
     * Customer constructor.
     *
     * @param string $name
     * @param int $tickets
     */
    public function __construct(string $name, int $tickets)
    {
        $this->name = $name;
        $this->tickets = $tickets;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTickets(): int
    {
        return $this->tickets;
    }
}
