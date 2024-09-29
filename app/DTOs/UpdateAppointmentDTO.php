<?php

namespace App\DTOs;

/**
 * Defines the optional fields that can be used to update an appointment
 */
class UpdateAppointmentDTO
{
    public ?string $author;
    public ?string $content;
    public ?int $score;

    public function __construct(?string $author, ?string $content, ?int $score)
    {
        $this->author = $author;
        $this->content = $content;
        $this->score = $score;
    }
}
