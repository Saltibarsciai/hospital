<?php

namespace App\Repository\AppointmentRepository;

use Illuminate\Http\Request;

interface AppointmentRepositoryInterface
{
    public function create(Request $request);
    public function getAll();
    public function get($id);
    public function update(Request $request, $id);
    public function delete($id);
}
