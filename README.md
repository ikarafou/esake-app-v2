# ESAKE Basketball Tracker 2.0

A redesigned and extended version of the ESAKE basketball application "BasketGameTracker"

## Overview

ESAKE App 2.0 is a full-stack basketball application focused on managing and presenting information about teams, players, championships, games, and users.

The project consists of a PHP-based backend and an Android mobile application, with the backend environment being containerized using Docker.

This version is a continuation and redesign of an earlier project, with the goal of improving the architecture, functionality, and overall development experience.

## Project Structure

```
esake-app-v2/
├── backend/              # PHP backend application
│   ├── api/              # API endpoints
│   │   ├── teams/        # Team management endpoints
│   │   ├── players/      # Player management endpoints
│   │   ├── championships/# Championship endpoints
│   │   ├── games/        # Game management endpoints
│   │   └── users/        # User authentication
│   ├── pages/            # Frontend pages
│   ├── includes/         # Shared PHP includes
│   ├── photos/           # Player photos
│   ├── index.php         # Main entry point
│   └── Dockerfile        # Backend Docker configuration
│
├── database/             # Database files
│   └── esakeDB.sql       # Database schema
│
├── android-app/          # Android mobile application
│
└── docker-compose.yml    # Development environment
```

## Tech Stack

### Backend

* PHP
* REST API
* MySQL
* Docker

### Android

* Android

## Current Status

🚧 **In development**

The backend is currently under active development. The Android application will be developed alongside the backend as the project progresses.

## Planned Features

* Team management
* Player management
* Championship management
* Game management
* User authentication
* Android mobile application
* Dockerized development environment

## Background

ESAKE App 2.0 is based on an earlier version of the project.

The goal of this version is to revisit the original implementation and build a more structured and maintainable application while expanding its functionality.

## License

This project is currently for educational and development purposes.
