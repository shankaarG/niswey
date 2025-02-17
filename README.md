Contact Management API (Laravel 11)

This is a Laravel 11 CRUD application for managing contacts. It includes a feature to bulk import contacts using an XML file.

Features

Create, Read, Update, Delete (CRUD) Contacts

Bulk Import Contacts via XML Upload

REST API Endpoints for Contact Management

Installation

1. Clone the Repository

git clone https://github.com/your-repo/niswey.git
cd niswey

2. Install Dependencies

composer install

3. Configure Environment

Rename the .env.example file to .env and update the database credentials:

cp .env.example .env
php artisan key:generate

Set up the database credentials inside .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

4. Run Migrations

php artisan migrate

5. Start the Application

php artisan serve

API Endpoints

1. Get All Contacts

Endpoint: GET /api/contacts

GET http://127.0.0.1:8000/api/contacts

2. Create a New Contact

Endpoint: POST /api/contacts

POST http://127.0.0.1:8000/api/contacts
Content-Type: application/json

Request Body:

{
    "name": "John Doe",
    "phone": "+90 333 1234567"
}

3. Get a Single Contact

Endpoint: GET /api/contacts/{id}

GET http://127.0.0.1:8000/api/contacts/1

4. Update a Contact

Endpoint: PUT /api/contacts/{id}

PUT http://127.0.0.1:8000/api/contacts/1
Content-Type: application/json

Request Body:

{
    "name": "Updated Name",
    "phone": "+90 333 6543210"
}

5. Delete a Contact

Endpoint: DELETE /api/contacts/{id}

DELETE http://127.0.0.1:8000/api/contacts/1

Bulk Import Contacts via XML

Endpoint: POST /api/contacts/import-xml

POST http://127.0.0.1:8000/api/contacts/import-xml

Postman Configuration:

Method: POST

Headers:

Content-Type: multipart/form-data

Body:

Key: xml_file

Value: Upload the XML file

Sample XML File

<?xml version="1.0" encoding="UTF-8"?>
<contacts>
    <contact>
        <name>John Doe</name>
        <phone>+90 333 1234567</phone>
    </contact>
    <contact>
        <name>Jane Smith</name>
        <phone>+90 333 7654321</phone>
    </contact>
</contacts>

Expected Response:

{
    "message": "Contacts imported successfully"
}

