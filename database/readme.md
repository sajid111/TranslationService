# Translation Service API

# Overview

This Service provides a robust and scalable solution for managing translations across multiple locales. It supports:

Storing translations for multiple languages.
Tagging translations with contexts (e.g., mobile, desktop, web).
CRUD operations for translations.
JSON responses optimized for frontend applications.
Caching for optimized performance.
Secure authentication using Laravel Sanctum.

# Database Design

I have followed 3rd Normal Form (3NF) to ensure efficiency and avoid data redundancy.
Tables:
languages - Stores available languages.
translations - Stores translation keys, language references, and content.
tags - Stores contextual tags.
translation_tag - Pivot table for many-to-many relations between translations and tags.

# Design Patterns & Best Practices

    1. Dependency Injection

    We use service classes to handle business logic instead of writing logic in controllers. This improves maintainability.

    2. Service Class Architecture

    The TranslationService class handles all translation-related operations

    3. Single Responsibility Principle (SRP)

    Controllers only handle HTTP requests.
    Services handle business logic.
    Models interact with the database.
    Request classes handle validation.
    
    4. Radis Caching for Optimization

    To improve API response times, translations are cached

    5. JSON API Resources

    Added Laravel Resources for standard json response return

    6. Custom Base Class For Response Method

    Added custom base class for standard api response methods with all attributes [status,message,data,status_code]

    7. Laravel Sanctum

    USe laravel sanctum for authentication for securing all apis

    8 .Unit Test 

    Write Unit Tests For testing every functionality is working

# Setup Instructions

# 1. Clone the Repository

    git clone https://github.com/your-repo-url.git
    change branch master

# 2. Install Dependencies

    composer install

# 3. Set Up Environment

    Copy the example .env file and configure database and Redis settings.

    cp .env.example .env

    Update the following fields in the .env file:

    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

# 4. Run Migrations and Seeders

php artisan migrate --seed
This will:
Populate initial data for languages and tags.
Add a default user with an authentication token.

# 5. Create an Admin User for API Authentication

php artisan tinker

$user = \App\Models\User::factory()->create();
$token = $user->createToken('API Token')->plainTextToken;
echo "Your API token: $token";

Save this token and use it in your API requests.

# 6. Run the Server

# Running Tests

php artisan test --filter=TranslationServiceTest

