

# Laravel Application

This is a Laravel api built with graphql for a task management service.

## Getting Started

These instructions will guide you through setting up and running the Laravel application on your local machine.

### Prerequisites

Before you begin, ensure you have the following software installed:

- [PHP](https://www.php.net/downloads.php) (>= 7.4)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/) (LTS version recommended)
- [npm](https://www.npmjs.com/get-npm)
- [MySQL](https://dev.mysql.com/downloads/) or [SQLite](https://www.sqlite.org/download.html)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Keania-Eric/laravel-graphql-task-api.git
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```


4. Create a copy of the `.env.example` file and name it `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Set up your database configuration in the `.env` file. For example, using Mysql:

   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=aptiw-api
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Run database migrations :

   ```bash
   php artisan migrate
   ```


### Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Your application should now be accessible at `http://localhost:8000`.



