# Vaccine Kahf Guard

A Laravel application for vaccine registration, scheduling, and status tracking. This project manages user registration for vaccines, schedules vaccination dates based on the vaccine center's availability, and sends notification emails the night before the scheduled vaccination date.

## Table of Contents

1. Requirements
2. Installation
3. Environment Configuration
4. Database Setup and Seeding
5. Running the Application
6. Configure Mail Settings
7. Schedule The Task -> Email Notification
8. Important Notes

---

## 1. **Requirements**:

Make sure you have the following installed:

- PHP >= 8.0
- Composer
- MySQL or MariaDB
- Git
- Node.js
- Laravel 10.x

## 2. **Installation**:

i. Clone the Repository -> Open your terminal and clone this repository

    git clone https://github.com/parvezbi/vaccine-kahf-guard.git


ii. Navigate to the Project Directory

    cd vaccine-kahf-guard

iii. Install Dependencies -> Run the following command to install the necessary PHP dependencies:

    composer install

## 3. **Environment Configuration**:

i. Copy the `.env.example` file -> Create a new `.env` file by copying the `.env.example` file:

    cp .env.example .env

ii. Generate an Application Key -> Run the following command to generate an application key:

    php artisan key:generate

iii. Configure the Database -> Open the `.env` file and configure the database connection by setting the following variables:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=vaccine_db
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    

## 4. **Database Setup and Seeding**:

i. Run Migrations -> Run the following command to migrate the database schema:

    php artisan migrate

ii. Run Seeders -> Run the following command to seed the database with initial data:

    php artisan db:seed

## 5. **Running the Application**: Run the following command to run the application

    php artisan serve

## 6. **Configure Mail Settings**: You can use https://mailtrap.io

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_username
    MAIL_PASSWORD=your_mailtrap_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="yourmail"
    MAIL_FROM_NAME="${APP_NAME}"

   You can register though your mail and write the mail here in .env and setup the smtp and run the schedule commands, thats it.

## 7. **Schedule The Task -> Email Notification**:

i. **Run the following command to run the task schedule**:
    
    php artisan schedule:run

ii. **Run the following command to test the task schedule**:

    php artisan schedule:test

## 8. **Important Notes**:
	if schedule is not working
	1. Go to db table scheduled_vaccinations and take the user_id and change the email of the user from users table, set your MAIl_FROM_ADDRESS which one you used in .env
	2. then run php artisan config:clear
