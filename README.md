# Car Rental Website
![image](https://github.com/Kv0nzee/car_rental/assets/62888962/07d97757-3a21-461c-9ed9-3adc33735ff5)

On this project, users may look at cars, rent them, look at their rental records, and carry out CRUD operations on listings. The front end uses Vue.js, and the API in the back end uses Laravel.

## Technologies Used

- **Frontend:** Vue.js
- **Backend:** Laravel
- **Database:** mysql

## API Documentation

- **getSingleCar**: [http://127.0.0.1:8000/api/cars/[car name]](http://127.0.0.1:8000/api/cars/[car name])
  - Retrieves information about a single car by its name.

- **getAllCars**: [http://127.0.0.1:8000/api/cars](http://127.0.0.1:8000/api/cars)
  - Retrieves information about all available cars.

- **getAllCategories**: [http://127.0.0.1:8000/api/categories](http://127.0.0.1:8000/api/categories)
  - Retrieves information about all car categories.

- **register** (POST): [http://127.0.0.1:8000/api/register](http://127.0.0.1:8000/api/register)
  - Registers a new user.

- **Insert Rented Car** (POST): [http://127.0.0.1:8000/api/rent](http://127.0.0.1:8000/api/rent)
  - Inserts a new rented car record.

- **login** (POST): [http://127.0.0.1:8000/api/login?email=[email]&password=[password]](http://127.0.0.1:8000/api/login?email=[email]&password=[password])
  - Logs in a user with the specified email and password.

- **getAllBrands**: [http://127.0.0.1:8000/api/brands](http://127.0.0.1:8000/api/brands)
  - Retrieves information about all car brands.

- **getAllCarswithfilters**: [http://127.0.0.1:8000/api/rent?car=eclipse%20cross%204wd&user=user](http://127.0.0.1:8000/api/rent?car=eclipse%20cross%204wd&user=user)
  - Retrieves information about all cars with applied filters.

- **getSingleRentCar**: [http://127.0.0.1:8000/api/rent/[id]](http://127.0.0.1:8000/api/rent/[id])
  - Retrieves information about a single rented car by its ID.


## How to Run Locally

To run the Car Rental Website project locally, follow these steps:

1. **Clone the repository**:
2. **Navigate to the project directory**: cd car-rental-website
3. **Install frontend dependencies**: npm install
4. **Start the frontend server**: npm run dev
5.  **Access the application**: Open your web browser and go to http://localhost:5173  (or the appropriate URL if the port is different) to view the application.
6. **Install backend dependencies**: composer install or composer install --ignore-platform-reqs
7. **Ensure MySQL is enabled**: If XAMPP is not installed, download and install it. Then, ensure that MySQL is enabled in the XAMPP control panel.
8. **Migrate the database**: In the backend terminal, run the command: php artisan migrate:fresh --seed
9. **Start the backend server**: php artisan serve
10. **Access the API**: Open your web browser and go to http://localhost:8000/api  (or the appropriate URL if the port is different) to access the API.
