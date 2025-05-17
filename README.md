# [Lravel Cafe and Tea shop]

[the app aim to make a small cafe shop to be able to accept online order but the user have to pick it up themselves]

This is a boilerplate/template/application built using the Laravel PHP Framework.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before you begin, ensure you have the following software installed on your system:

-   **PHP:** Version 7.4 or higher is generally recommended for modern Laravel projects (check your specific Laravel version requirements). Ensure required PHP extensions (like `pdo`, `mbstring`, `xml`, `curl`, `bcmath`, `json`, `fileinfo`, `tokenizer`, `openssl`, `zip`) are enabled.
-   **Composer:** A dependency manager for PHP.
    -   [Download Composer](https://getcomposer.org/download/)
-   **Node.js & npm/yarn:** Required if your project uses frontend assets built with tools like Vite, Laravel Mix, or Webpack.
    -   [Download Node.js (includes npm)](https://nodejs.org/en/download/)
    -   [Install yarn (Optional)](https://yarnpkg.com/getting-started/install)
-   **Database System:** You'll need a database like MySQL, PostgreSQL, SQLite, or SQL Server. For local development, SQLite or a local MySQL/PostgreSQL server is common.
-   **Git:** For cloning the repository.
    -   [Download Git](https://git-scm.com/downloads)

### Installation

Follow these steps to get your development environment set up:

1.  **Clone the repository:**

    ```bash
    mkdir [make new dir to store the project]
    cd [to your new created dir]
    git clone [https://github.com/GonnaTried/laravel-cafe-tea-shop .]
    ```

2.  **Install PHP dependencies:** Use Composer to install all the required backend libraries.

    ```bash
    composer install
    ```

3.  **Install Frontend dependencies (if applicable):** If your project uses `package.json` for frontend assets, install them using npm or yarn.

    ```bash
    npm install
    # OR
    # yarn install
    ```

4.  **Create environment file:** Laravel uses an environment file (`.env`) to manage application configuration (database credentials, API keys, etc.). A `.env.example` file is usually provided.

    ```bash
    cp .env.example .env
    ```

5.  **Configure your environment:** Open the newly created `.env` file in a text editor.

    -   Set `APP_URL` to your local URL (e.g., `http://localhost:8000`).
    -   Configure your database connection details (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    -   Adjust any other necessary settings (e.g., mail configuration, cache driver).

    ```env
    APP_NAME="[Laravel Cafe and Tea Shop]"
    APP_ENV=local
    APP_DEBUG=true
    APP_URL=http://localhost:8000 # Or the URL you will access the app at

    LOG_CHANNEL=stack
    LOG_LEVEL=debug

    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    #DB_PORT=3306
    #DB_DATABASE=[YOUR_DATABASE_NAME]
    #DB_USERNAME=[YOUR_DATABASE_USERNAME]
    #DB_PASSWORD=[YOUR_DATABASE_PASSWORD]

    # ... other configurations ...
    ```

6.  **Generate Application Key:** This command sets the `APP_KEY` in your `.env` file, which is used for encrypting sessions and other data.

    ```bash
    php artisan key:generate
    ```

    -   _Note: If the `.env` file wasn't created correctly in step 4, this command might fail or put the key in the wrong place. Ensure `.env` exists and is writable._

7.  **Run Database Migrations:** This sets up the necessary database tables based on the migration files in `database/migrations`.

    ```bash
    php artisan migrate
    ```

    -   _If you need to start fresh, you can use `php artisan migrate:fresh` (caution: this will drop all existing tables)._
    -   _If your project includes seeders to populate the database with initial data, run:_
        ```bash
        php artisan db:seed
        ```

8.  **Build Frontend Assets (if applicable):** Compile your CSS and JavaScript files.
    ```bash
    npm run dev
    # OR
    # yarn dev
    # Use `npm run watch` or `yarn watch` during development for automatic recompilation on file changes.
    # Use `npm run build` or `yarn build` for production-ready assets.
    ```

### Running the Application

Once all the setup steps are complete, you can start the local development server:

```bash
php artisan serve

```
