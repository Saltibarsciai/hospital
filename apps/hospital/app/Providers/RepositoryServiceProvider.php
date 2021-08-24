<?php

namespace App\Providers;

use App\Repository\AppointmentRepository\AppointmentRepositoryInterface;
use App\Repository\AppointmentRepository\MysqlAppointmentRepository;
use App\Repository\DoctorRepository\DoctorMysqlRepository;
use App\Repository\DoctorRepository\DoctorRepositoryInterface;
use App\Repository\DrugsRepository\DrugsMysqlRepository;
use App\Repository\DrugsRepository\DrugsRepositoryInterface;
use App\Repository\PatientRepository\PatientMysqlRepository;
use App\Repository\PatientRepository\PatientRepositoryInterface;
use App\Repository\PrescriptionRepository\PrescriptionMysqlRepository;
use App\Repository\PrescriptionRepository\PrescriptionRepositoryInterface;
use App\Repository\ReceptionistRepository\ReceptionistMysqlRepository;
use App\Repository\ReceptionistRepository\ReceptionistRepositoryInterface;
use App\Repository\ReservationRepository\ReservationMysqlRepository;
use App\Repository\ReservationRepository\ReservationRepositoryInterface;
use App\Repository\UserRepository\MysqlUserRepository;
use App\Repository\UserRepository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PatientRepositoryInterface::class, function() {
            return new PatientMysqlRepository();
        });
        $this->app->bind(ReservationRepositoryInterface::class, function() {
            return new ReservationMysqlRepository();
        });
        $this->app->bind(PrescriptionRepositoryInterface::class, function() {
            return new PrescriptionMysqlRepository();
        });
        $this->app->bind(AppointmentRepositoryInterface::class, function() {
            return new MysqlAppointmentRepository();
        });
        $this->app->bind(UserRepositoryInterface::class, function() {
            return new MysqlUserRepository();
        });
        $this->app->bind(DrugsRepositoryInterface::class, function() {
            return new DrugsMysqlRepository();
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
