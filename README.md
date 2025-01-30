
## Project Setup Guide  🚀

This guide will help you set up the project on your local machine.

### Prerequisites
Ensure you have the following installed:

- PHP 8.x (recommended: 8.1 or later).
- Composer (dependency manager for PHP)
- MySQL (or the database used in the project)
- Node.js & npm/pnpm (for frontend assets, if applicable)
- Docker (Optional) if using Laravel Sail


### Clone the Project

Run the following command in your terminal:
    
    git clone git@github.com:redaEnnakouri/tmdb-test.git 
    cd tmdb-test


###  Install Dependencies

    composer install

### Install JavaScript Dependencies (If applicable)

    npm install
    or
    pnpm install

## Environment Configuration

    cp .env.example .env

## Database Setup
Update .env with your database credentials:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=root
    DB_PASSWORD=your_password


## Run Migrations & Seeders

    php artisan migrate --seed

## Run the Application

    php artisan serve

Access the project at: http://127.0.0.1:8000

### Using Laravel Sail (if applicable)
If you're using Laravel Sail (Docker-based), start the project with:

    ./vendor/bin/sail up -d

### Compile Frontend Assets (If applicable)

    npm run dev
    or
    pnpm run dev


### Setting Up the API Key

Add your API key to the .env file:

    TMDB_API_KEY=your_api_key

### Running the Command

if you want to fetch the movies from the API, you can run the following command:

    php artisan fetch:movies

if you are using Laravel Sail, you can run the command inside the container:

    ./vendor/bin/sail artisan fetch:movies

### How It Works
- The command fetches data from the external API using the configured API key.
- It processes the received data and updates the corresponding records in the database.
- The command is scheduled to run every 24 hours.

### Scheduling Automatic Updates (Optional)
To run the command automatically, you can schedule it inside app/Console/Kernel.php:

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(StoreFilmsCommand::class)->daily();
    }

### ✅ Your Laravel project is now set up! 🎉

## License & Copyright

© 2025 Reda. All rights reserved.

This project and its source code are the intellectual property of Reda.  
The project is licensed under the [MIT License](LICENSE.md).
