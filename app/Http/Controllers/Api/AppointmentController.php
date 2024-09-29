<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function getAllAppointments()
    {
        $appointments = $this->appointmentService->getAllAppointments();
        return response()->json($appointments->toArray(), 200);
    }

    public function createAppointment(CreateAppointmentRequest $request)
    {
        try {
            $dto = $request->toCreateAppointmentDTO();
            $appointment = $this->appointmentService->createAppointment($dto);
            return response()->json($appointment->toArray(), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAppointment($id)
    {
        $appointment = $this->appointmentService->getAppointmentById((int) $id);
        if ($appointment) {
            return response()->json($appointment->toArray(), 200);
        } else {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
    }

    public function updateAppointment(UpdateAppointmentRequest $request, int $id)
    {
        try {
            $appointment = $this->appointmentService->getAppointmentById($id);
            if (!$appointment) {
                return response()->json(['error' => 'Appointment not found'], 404);
            }
            $dto = $request->toUpdateAppointmentDTO();
            $updatedAppointment = $this->appointmentService->updateAppointment($id, $dto);
            return response()->json($updatedAppointment, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function deleteAppointment($id)
    {
        $appointment = $this->appointmentService->deleteAppointmentById((int) $id);
        if ($appointment) {
            return response()->json($appointment->toArray(), 200);
        } else {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
    }
}
