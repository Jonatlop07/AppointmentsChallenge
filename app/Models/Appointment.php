<?php

namespace App\Models;

use App\DTOs\AppointmentDTO;
use App\DTOs\CreateAppointmentDTO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Maps the payload data to create a new record in the database
     * through the model
     */
    public static function fromCreateAppointmentDTO(CreateAppointmentDTO $dto): self
    {
        $appointment = new self();
        $appointment->author = $dto->author;
        $appointment->content = $dto->content;
        $appointment->score = $dto->score;
        return $appointment;
    }

    /**
     * Maps the model representation of a record in the database
     * to the main representation of this data in the application
     */
    public static function toAppointmentDTO(self $appointment): AppointmentDTO
    {
        return new AppointmentDTO(
            $appointment->id,
            $appointment->author,
            $appointment->content,
            $appointment->score,
            $appointment->created_at,
            $appointment->updated_at
        );
    }
}
