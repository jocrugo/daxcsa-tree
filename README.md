# Binary Genealogy Tree - Daxcsa Tree

## Description

This project implements a visual interface for a binary genealogy tree using **Laravel** as the backend and **Vue.js** as the frontend. The tree structure is loaded from a JSON file (`daxcsa.json`) and rendered dynamically as an interactive diagram.

## Features

- Reads data from `daxcsa.json` (located in `storage/app/daxcsa.json`).
- Renders genealogy nodes in a binary tree layout.
- Vue components for each node and their connections.
- Laravel routes and controllers serve the main view and provide a data API.

## Requirements

- PHP >= 8.0
- PHP extensions: `mbstring`, `pdo_mysql`, `gd` (optional if adding images)
- Composer
- Node.js >= 14.x and npm or Yarn
- MySQL database (can adapt to PostgreSQL by updating configuration)

## Local Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/YOUR_USERNAME/daxcsa-tree.git
   cd daxcsa-tree
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install       # or yarn install
   ```
3. Copy and configure the environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Update database credentials in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```
5. Run database migrations:
   ```bash
   php artisan migrate
   ```

## Development & Build

- Start development server with hot-reload:
  ```bash
  npm run dev        # or yarn dev
  php artisan serve
  ```
- Generate production assets:
  ```bash
  npm run build      # or yarn build
  ```

## Usage

Open your browser at:

```
http://127.0.0.1:8000
```

The main view will display the genealogy tree loaded from `daxcsa.json`.

## Project Structure

```
├── app/
├── config/
├── database/
│   └── migrations/
├── public/
│   └── index.php
├── resources/
│   ├── js/
│   │   └── components/   # Vue components
│   └── views/            # Blade templates
├── routes/
│   └── web.php           # route for the tree view
├── storage/
│   └── app/
│       └── daxcsa.json   # JSON data file
├── .env.example
├── composer.json
├── package.json
└── README.md
```

## Screenshot
![image](https://github.com/user-attachments/assets/047b0392-7600-4891-8050-8f95588aa99d)
![image](https://github.com/user-attachments/assets/cb0e43ef-a035-45a4-8a86-1a86a2811a02)
![image](https://github.com/user-attachments/assets/b6c685e8-99d8-4b90-9ee6-5cf1e4e60643)




## Example JSON

The file `storage/app/daxcsa.json` contains an array of node objects in the following format:

```json
[
  {
    "id": "1",
    "name": "Root",
    "left": "2",
    "right": "3"
  },
  ...
]
```

## Deployment

To provide a live demo with a PHP backend, you can use:

- **Heroku** (PHP buildpack)
- **Railway** or **DigitalOcean App Platform**

Deliverables should include:

1. **Link to the GitHub repository**
2. **Screenshot** (`screenshots/tree.png`)
3. **Live demo URL** (optional)


