
# Task Management System

## Overview
The Task Management System is a robust and user-friendly application designed to help users efficiently manage their tasks. Built with a Laravel backend and a Next.js frontend, this system provides seamless task creation, updating, deletion, and completion functionalities. The application leverages Laravel Sanctum for secure user authentication and Docker for containerization, ensuring a scalable and maintainable solution.

## Features
- **User Authentication**: Secure user registration and login using Laravel Sanctum.
- **Task Management**: 
  - **Create Tasks**: Users can create new tasks with a title, description, status, and due date.
  - **Retrieve Tasks**: Users can view all their tasks with pagination support for better task management.
  - **Update Tasks**: Users can update task details, including the title, description, status, and due date.
  - **Delete Tasks**: Users can delete tasks they no longer need.
  - **Mark Tasks as Completed**: Users can mark tasks as completed to keep track of their progress.
- **API Documentation**: Comprehensive API documentation provided via a Postman collection or README file.
- **Server-Side Rendering (SSR) and Static Site Generation (SSG)**: Utilized in the Next.js frontend for optimal performance and SEO.
- **Containerization**: Both the backend and frontend applications are containerized using Docker for easy deployment and scalability.

## Technologies Used
- **Backend**: Laravel 9, Laravel Sanctum
- **Frontend**: Next.js
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **API Documentation**: Postman

## Getting Started

### Prerequisites
- PHP 8.0 or higher
- Composer
- Node.js and npm

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/your-repository.git
   cd your-repository
   ```

2. **Set Up the Backend**:
   - Install dependencies:
     ```bash
     composer install
     ```
   - Set up the environment variables:
     ```bash
     cp .env.example .env
     php artisan key:generate
     ```
   - Configure your `.env` file with your database and mail settings.
   - Run migrations:
     ```bash
     php artisan migrate
     ```

3. **Run the Application**:
   - Start the backend server:
     ```bash
     php artisan serve
     ```
   - Start the frontend server:
     ```bash
     npm start
     ```

## API Endpoints

### Authentication
- `POST /api/register`: Register a new user
- `POST /api/login`: Login and get a token
- `POST /api/logout`: Logout and revoke the token
- `POST /api/forgot-password`: Send password reset link
- `POST /api/reset-password`: Reset password

### Tasks
- `GET /api/tasks`: Retrieve all tasks for the logged-in user
- `POST /api/tasks`: Create a new task
- `GET /api/tasks/{id}`: Retrieve a specific task
- `PUT /api/tasks/{id}`: Update a task
- `DELETE /api/tasks/{id}`: Delete a task
- `PATCH /api/tasks/{id}/complete`: Mark a task as completed

## Conclusion
The Task Management System is a comprehensive solution for managing tasks efficiently. With secure authentication, robust task management features, and seamless integration between the backend and frontend, this system is designed to enhance productivity and organization.

---
