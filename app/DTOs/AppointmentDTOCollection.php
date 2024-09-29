<?php

namespace App\DTOs;

use ArrayIterator;
use IteratorAggregate;

/**
 * This is used to represent in a more controllable way
 * the type of a collection of appointments throughout the application
 */
class AppointmentDTOCollection implements IteratorAggregate
{
    private array $appointments;

    public function __construct(array $appointments = [])
    {
        $this->appointments = $appointments;
    }

    public function add(AppointmentDTO $appointment): void
    {
        $this->appointments[] = $appointment;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->appointments);
    }

    /**
     * Used for serialization purposes
     */
    public function toArray(): array
    {
        return $this->appointments;
    }
}
