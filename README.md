# Appointments App Documentation

## Setup and Running

I use docker containers to deploy the components (Database, Rest Api and ELT Script)

-   First, clone the repository.

-   You should have Docker and Docker Compose on your machine. `cd` to the root folder of the project and run the following commands to setup the app:

`docker compose up db app --build -d`

-   You can access the Postman Collection under the folder `/postman-collections`. There you can find the following endpoints:

    -   Get all appointments (`GET /api/appointments`)
    -   Get appointment by id (`GET /api/appointments/{appointmentId}`)
    -   Create appointment (`POST /api/appointments/`)
    -   Update appointment (`PATCH /api/appointments/{appointmentId}`)
    -   Delete appointment (`DELETE /api/appointments/{appointmentId}`)
    -   There are already created Postman variables to setup the url of the API (using the docker containers, I expose it on port 9000)
        and also to manage easily the parameters to create and update appointments, and to identify a single appointment (in order to query, delete or update it).
    -   Input data for appointments will be validated (ensuring that the type of the data is as expected, and in case of the field `score` it should be in the range [0, 5])

-   Next, run the following command to create the ELT script container:

`docker compose up elt --build -d`

-   To execute the ELT and see the top 5 appointments retrieved by the ELT in json format, run the following command:

`docker exec elt python /app/appointments_elt.py --use-cache --cache-data`

-   The parameters of the script are:

    -   `--use-cache` tells the script to execute the logic on the last saved records on the cache. If there is no data in the cache, the GET request is made to retrieve the current appointments in the database.
    -   `--cache-data` tells the script to save the retrieved appointments in the cache

-   **Env file is committed for ease of configuration**
