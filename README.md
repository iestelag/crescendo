Crescendo
Crescendo is a full-stack web application designed for the academic management of music schools.
The project was developed individually as part of my Web Application Development studies. Its main goal is to centralize the management of students, teachers, classes and academic communication in a single platform.
The application includes a public website and a private area with different functionalities depending on the user's role.
Features
Administrator
The administrator can manage:
- Teachers
- Students
- Subjects
- Classes
- Enrolments
- General announcements
The management system includes creation, editing and deactivation of records.
Teacher
Teachers can:
- View their assigned classes
- Create publications for students
- Publish tasks
- Share learning materials
- Post informational messages
- Edit or deactivate previous publications
Student
Students can:
- View their enrolled classes
- Access teacher publications
- View tasks and learning materials
- Read general announcements
Technologies
- PHP
- MySQL
- JavaScript
- HTML5
- CSS3
- Bootstrap 5
- AJAX
- Docker
- Docker Compose
- phpMyAdmin
- Git
Architecture
Crescendo follows a layered architecture with separation between presentation, business logic and data persistence.
The backend is developed in PHP following an MVC-based structure:
- Models manage data access and database operations
- Controllers process application logic and user actions
- Views display information to the user
The frontend is built with HTML5, CSS3, JavaScript and Bootstrap 5.
The application follows a Multi Page Application structure, with dynamic pages generated from the server.
Database
The project uses a relational MySQL database.
The main entities are:
- Users
- Teachers
- Students
- Subjects
- Classes
- Enrolments
- Publications
- Announcements
Primary and foreign keys are used to maintain the relationships between the different entities.
The database script is available at:
database/crescendo.sql
All data included in the SQL file is fictional and was created exclusively for development and demonstration purposes.
Docker
The project includes a Docker environment with:
- Apache + PHP
- MySQL 8
- phpMyAdmin
Docker Compose is used to manage the services and make the development environment easier to reproduce.
The environment can be started with:
docker compose up -d
The application is available at:
http://localhost:8080
phpMyAdmin is available at:
http://localhost:8081
Configuration
The local database configuration file is excluded from the repository.
A configuration template is included at:
config/config.example.ini
Create a local file called:
config/config.ini
and configure the database connection.
Example:
[database]
host = localhost
dbname = crescendo
user = your_user
password = your_password
charset = utf8mb4
Interface
The interface was developed using Bootstrap 5 together with custom CSS.
The project includes:
- Responsive layouts
- CSS Grid and Flexbox
- Reusable components
- Responsive navigation
- Role-specific panels
- Semantic HTML5
- Accessible forms
- Consistent visual design
The interface adapts to desktop, tablet and mobile devices.
Development
Crescendo was developed individually, covering different stages of the software development lifecycle:
- Requirements analysis
- Database design
- UI/UX design
- Frontend development
- Backend development
- Functional testing
- Documentation
- Deployment configuration
Project structure
crescendo/
├── ajax/
├── config/
├── controladores/
├── database/
├── estilos/
├── imagenes/
├── includes/
├── js/
├── modelos/
├── paginas/
├── index.php
├── docker-compose.yml
└── dockerfile
Screenshots
Screenshots of the main areas of the application will be added here:
- Public website
- Administrator panel
- Teacher panel
- Student panel
