##API

https://hospital.test/api/prescriptions/v1/by-patient/1

gives prescriptions by patient

https://hospital.test/api/prescriptions/v1/

gives all prescriptions

##WEB

https://hospital.test/


##INSTALATION

prerequisites:

- Docker

Steps

- docker-compose up -d

## Task

General tasks:

● Ability for users to:

○ Register

○ Login

○ Password reset

● Receptionists can register patients to appointment, change the time of an

appointment or cancel them.

○ appointments should be reserved if one receptionist is registering a patient

already.

● Doctor should be able to see the list of patients (paginated)

● Doctor should be able to see the list of prescriptions (paginated)

○ Doctors can create, view and cancel prescriptions.

○ Prescription can be canceled until 1 hour after being created.

● Patients should receive an email about prescriptions assigned.

● Make an API for pharmacies to check prescriptions.
Bonus tasks:

● Create a list of drugs ( Fake 20k+ records);

● Dashboard with statistics about prescribed drugs.

● Dockerize an application

● Unit tests
If any clarification is required do not hesitate to write the person who sent you the task
