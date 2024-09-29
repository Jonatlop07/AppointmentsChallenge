<?php

namespace App\Repositories;

use App\DTOs\AppointmentDTO;
use App\DTOs\AppointmentDTOCollection;
use App\DTOs\CreateAppointmentDTO;
use App\DTOs\UpdateAppointmentDTO;

/**
 * This interface specifies the available appointment-related data access
 * and management operations in order to decouple it from possible implementations
 */
interface AppointmentRepository
{
    function findAll(): AppointmentDTOCollection;
    function findById(int $id): ?AppointmentDTO;
    function create(CreateAppointmentDTO $newApppointment): AppointmentDTO;
    function update(int $id, UpdateAppointmentDTO $updates): AppointmentDTO;
    function deleteById(int $id): ?AppointmentDTO;
}
