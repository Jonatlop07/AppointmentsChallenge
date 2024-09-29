<?php

namespace App\Repositories\Adapters;

use App\Repositories\AppointmentRepository;
use App\DTOs\CreateAppointmentDTO;
use App\DTOs\UpdateAppointmentDTO;
use App\DTOs\AppointmentDTO;
use App\DTOs\AppointmentDTOCollection;
use App\Models\Appointment;
use Carbon\Carbon;

/**
 * Used to implement the repository using Eloquent ORM
 */
class AppointmentRepositoryAdapter implements AppointmentRepository
{
    public function findAll(): AppointmentDTOCollection
    {
        $appointments = Appointment::all();
        $appointmentDTOs = new AppointmentDTOCollection();

        foreach ($appointments as $appointment) {
            $appointmentDTOs->add(Appointment::toAppointmentDTO($appointment));
        }

        return $appointmentDTOs;
    }

    public function findById(int $id): ?AppointmentDTO
    {
        $appointment = Appointment::find($id);
        return $appointment ? Appointment::toAppointmentDTO($appointment) : null;
    }

    public function create(CreateAppointmentDTO $newAppointmentData): AppointmentDTO
    {
        $appointment = Appointment::fromCreateAppointmentDTO($newAppointmentData);
        $appointment->save();
        return Appointment::toAppointmentDTO($appointment);
    }

    public function update(int $id, UpdateAppointmentDTO $updates): AppointmentDTO
    {
        $appointmentToUpdate = Appointment::findOrFail($id);
        if ($updates->author !== null) {
            $appointmentToUpdate->author = $updates->author;
        }
        if ($updates->content !== null) {
            $appointmentToUpdate->content = $updates->content;
        }
        if ($updates->score !== null) {
            $appointmentToUpdate->score = $updates->score;
        }
        $appointmentToUpdate->updated_at = new Carbon();
        $appointmentToUpdate->save();
        return Appointment::toAppointmentDTO($appointmentToUpdate);
    }

    public function deleteById(int $id): ?AppointmentDTO
    {
        $appointmentToDelete = Appointment::find($id);
        if ($appointmentToDelete) {
            $appointmentToDelete->delete();
        }
        return $appointmentToDelete ? Appointment::toAppointmentDTO($appointmentToDelete) : null;
    }
}
