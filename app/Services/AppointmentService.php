<?php

namespace App\Services;

use App\DTOs\AppointmentDTO;
use App\DTOs\AppointmentDTOCollection;
use App\Repositories\AppointmentRepository;
use App\DTOs\CreateAppointmentDTO;
use App\DTOs\UpdateAppointmentDTO;

/**
 * Class that implements application-level logic for Appointment-related use cases
 */
class AppointmentService
{
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getAllAppointments(): AppointmentDTOCollection
    {
        return $this->appointmentRepository->findAll();
    }

    public function getAppointmentById(int $id): ?AppointmentDTO
    {
        return $this->appointmentRepository->findById($id);
    }

    public function createAppointment(CreateAppointmentDTO $newAppointmentData): AppointmentDTO
    {
        return $this->appointmentRepository->create($newAppointmentData);
    }

    public function updateAppointment(int $id, UpdateAppointmentDTO $updates): AppointmentDTO
    {
        $updatedAppointment = $this->appointmentRepository->update($id, $updates);
        return $updatedAppointment;
    }

    public function deleteAppointmentById(int $id): ?AppointmentDTO
    {
        return $this->appointmentRepository->deleteById($id);
    }
}
