# Tello

Tello is a full-stack task management application built with Laravel, Vue.js, Inertia.js, and MySQL.

The application provides an authenticated workspace for creating, organizing, filtering, and tracking tasks, with dashboard summaries that give users a quick view of their current workload.

> **Status:** Functional project. Previously deployed publicly; the original hosting is no longer active and redeployment is planned.

## Tech Stack

**Backend**

<p>
  <img src="https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white" alt="MySQL">
</p>

**Frontend**

<p>
  <img src="https://img.shields.io/badge/Vue.js-4FC08D?logo=vuedotjs&logoColor=white" alt="Vue.js">
  <img src="https://img.shields.io/badge/Inertia.js-9553E9?logo=inertia&logoColor=white" alt="Inertia.js">
  <img src="https://img.shields.io/badge/Tailwind_CSS-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-646CFF?logo=vite&logoColor=white" alt="Vite">
</p>

## Core Functionality

### Task Management

Tello provides authenticated users with the core workflows needed to manage their tasks.

Users can:

- Create tasks
- View existing tasks
- Update task information
- Delete tasks
- Track task status
- Browse tasks through paginated results

Task operations are handled through Laravel backend workflows while Vue and Inertia provide the interactive frontend experience.

### Search & Filtering

Tello provides more than a basic CRUD task list.

Task querying is handled through a dedicated `TaskFilters` class, keeping filtering and query-related logic separate from the main controller workflow.

Users can narrow and organize their tasks using:

- Text search
- Task status
- Date-based filtering
- Sorting options

Filters can also be combined, allowing users to find specific groups of tasks without manually searching through their entire task list.

### Dashboard

The application includes a dashboard that summarizes task information for the authenticated user.

Dashboard counts provide a quick overview of task activity and status without requiring the user to inspect individual records.

### Authentication

Task management functionality is protected behind authentication so that application workflows operate within the context of the currently authenticated user.

This provides the foundation for user-specific task management rather than maintaining one shared global task list.

### Pagination

Task results are paginated to prevent the interface from loading the entire task collection at once.

Pagination works alongside the application's filtering and search functionality, allowing task lists to remain manageable as the amount of stored data increases.

## Application Architecture

Tello follows Laravel's application architecture while using Vue.js and Inertia.js for the frontend.

The application separates responsibilities across areas such as:

- Controllers
- Models
- Request validation
- Task filtering
- Database relationships
- Vue pages and components

The dedicated filtering layer keeps task-query logic reusable and prevents increasingly complex filtering conditions from being embedded directly inside controller actions.

## Technical Highlights

The project demonstrates:

- Full-stack Laravel and Vue.js development
- Inertia.js integration
- Relational data management with Eloquent
- Authenticated application workflows
- Task CRUD operations
- Search and multi-criteria filtering
- Dedicated query filtering architecture
- Date-based task filtering
- Dynamic sorting
- Pagination
- Dashboard aggregation
- Backend validation
- Responsive user interface development

## Project Status

The core application and task-management workflows are functional.

The project is currently offline and scheduled for redeployment.

## Future Improvements

Potential improvements include:

- Restoring the public deployment
- Expanding automated test coverage
- Additional task organization options
- Improved dashboard analytics
- UI and accessibility refinements
- Production deployment optimization

## Repository

The source code for Tello is maintained in this repository as part of my software development portfolio.

## License

No license is currently specified for this repository.

Unless a license is added, the source code should not be assumed to grant reuse, modification, or redistribution rights.
