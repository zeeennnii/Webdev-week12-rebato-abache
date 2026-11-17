# Week 12 Assessment: Reading List API

**Developers:** Rebato and Abache  
**Framework:** Laravel 13  
**Database:** PostgreSQL  
**Authentication:** Laravel Sanctum  
**Project:** Reading List API

## 1. Project Description

The Reading List API is a RESTful API developed using Laravel and PostgreSQL. It allows authenticated users to manage their personal reading lists by creating, viewing, updating, and deleting books.

The API uses Laravel Sanctum for token-based authentication and authorization. Each user can only access their own books, while read-only tokens are restricted from performing write operations.

## 2. Technologies Used

- PHP
- Laravel 13
- PostgreSQL
- Laravel Sanctum
- Eloquent ORM
- REST API
- Postman / PowerShell for API testing

## 3. Installation and Setup

1. Clone the repository:

   ```bash
   git clone <YOUR-GITHUB-REPOSITORY-URL>
   ```

2. Navigate to the project directory:

   ```bash
   cd webdev-week12-rebato-abache
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create your environment file:

   ```bash
   cp .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your PostgreSQL database credentials in the `.env` file.

7. Run migrations and seed the database:

   ```bash
   php artisan migrate:fresh --seed
   ```

8. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

The API will be available at:

`http://127.0.0.1:8000`

## 4. Database Relationships

| Tables | Relationship | Description |
|---|---|---|
| Users and Books | One-to-Many | A user can have multiple books. |
| Books and Users | Many-to-One | Each book belongs to one user. |
| Users and Personal Access Tokens | One-to-Many | A user can have multiple Sanctum tokens. |

## 5. API Endpoints

### Authentication

| Method | Endpoint | Description | Authentication |
|---|---|---|---|
| POST | `/api/register` | Register a new user | No |
| POST | `/api/login` | Login and receive an access token | No |
| POST | `/api/logout` | Revoke the current token |