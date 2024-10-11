# Vaccine Kahf Guard

A Laravel application for vaccine registration, scheduling, and status tracking. This project manages user registration for vaccines, schedules vaccination dates based on the vaccine center's availability, and sends notification emails the night before the scheduled vaccination date.

## Table of Contents

i. [Requirements](#requirements)
ii. [Installation](#installation)
iii. [Environment Configuration](#environment-configuration)
iv. [Database Setup](#database-setup)
v. [Scheduling Tasks](#scheduling-tasks)
vi. [Running the Application](#running-the-application)
vii. [Testing the Application](#testing-the-application)

---

i. Requirements

Make sure you have the following installed:

- PHP >= 8.0
- Composer
- MySQL or MariaDB
- Git
- Node.js
- Laravel 10.x

ii. Installation

1. **Clone the Repository**:

    Open your terminal and clone this repository:

    ```bash
    git clone https://github.com/parvezbi/vaccine-kahf-guard.git
    ```

2. **Navigate to the Project Directory**:

    ```bash
    cd vaccine-kahf-guard
    ```

3. **Install Dependencies**:

    Run the following command to install the necessary PHP dependencies:

    ```bash
    composer install
    ```

iii. Environment Configuration

1. **Copy the `.env.example` file**:

    Create a new `.env` file by copying the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

2. **Generate an Application Key**:

    Run the following command to generate an application key:

    ```bash
    php artisan key:generate
    ```

3. **Configure the Database**:

    Open the `.env` file and configure the database connection by setting the following variables:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=vaccine_db
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    Make sure you have a MySQL database created with the name `vaccine_db` (or another name of your choice) and that the username and password are correct.

iv. Database Setup

1. **Run Migrations**:

    Run the following command to migrate the database schema:

    ```bash
    php artisan migrate
    ```

2. **Run Seeders**:

    Run the following command to seed the database with initial data:

    ```bash
    php artisan db:seed
    ```

    This will populate your database with data such as vaccine centers and other essential entries.

v. Running the Application

    Run the following command to run the application:

    ```bash
    php artisan serve
    ```

vi. **Configure Mail Settings**:

    You need to configure the mail settings in `.env` to test the notification feature. If you're using [Mailtrap](https://mailtrap.io), set the following values:

    ```.env
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_username
    MAIL_PASSWORD=your_mailtrap_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="yourmail"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

   You can register though your mail and write the mail here in .env and setup the smtp and run the schedule commands, thats it.

vii. Schedule The Task -> Email Notification

    Run the following command to run the task schedule:

    ```bash
    php artisan schedule:run
    ```

    Run the following command to test the task schedule:

    ```bash
    php artisan schedule:test
    ```

viii. Important Notes
- if schedule is not working then check two things
	1. set you seheduled user email in database made by seeding {your email -> used in .env for MAIL_FROM_ADDRESS}
	2. then run php artisan config:clear
