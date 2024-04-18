### Running the Application

1. **Build Docker Services**

   Use the following command to build your Docker services:

    ```
    docker-compose build
    ```

2. **Start Docker Services**

   Use the following command to start your Docker services:

    ```
    docker-compose up -d
    ```

3. **Install Dependencies / Migrations / Run Tests / Generate Swagger**

   Change `.env.example` to `.env`.

   Navigate to the `www` folder and run the following command:

    ```
    ./setup.sh
    ```

4. **What's Done**

   All task done.

   Access the Swagger route at [http://localhost/api/documentation#/Books](http://localhost/api/documentation#/Books).
   
   API Route is available at [http://localhost/api/v1/books](http://localhost/api/v1/books).