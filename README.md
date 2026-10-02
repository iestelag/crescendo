# Crescendo

Crescendo is a web application developed as an educational platform for music students, teachers and administrators.

The project was built as part of my Web Application Development studies and includes different user roles, class management, student and teacher panels, authentication and database integration.

## Main features

- User authentication
- Student, teacher and administrator roles
- Student management
- Teacher management
- Class management
- Individual user panels
- Music subject management
- Administrative panel
- Database persistence
- Responsive web interface

## Technologies

- PHP
- JavaScript
- HTML5
- CSS3
- MySQL
- Docker
- AJAX
- Git

## Project structure

```text
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
```

## Database

The database structure and demo data are available in:

```text
database/crescendo.sql
```

The data included in the SQL file is fictional and was created exclusively for development and demonstration purposes.

## Configuration

The local database configuration file is not included in the repository.

A configuration template is available at:

```text
config/config.example.ini
```

Create a copy called:

```text
config/config.ini
```

and configure the database connection:

```ini
[database]
host = localhost
dbname = crescendo
user = your_user
password = your_password
charset = utf8mb4
```

## Running the project

The project includes Docker configuration files that can be used to create the required environment.

Alternatively, it can be executed using a local PHP and MySQL environment.

The database must first be created using:

```text
database/crescendo.sql
```

and the connection settings must then be configured in:

```text
config/config.ini
```

## Current status

The original version of Crescendo is complete as an academic project.

The project will also be used as a base for future development and experimentation with new features related to Artificial Intelligence and educational software.
