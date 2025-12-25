# Blog System (Laravel)

A junior-level multi-user blog system built using Laravel. Users can register, manage their profile, and create blog posts with image uploads.

---

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Project Overview](#project-overview)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

---

## Features

### User Authentication
- User registration
- User login
- Secure authentication system

### User Profile Management
- Update personal information
- Upload and update profile image
- View profile details

### Blog Management
- Create blog posts with image upload
- View only your own uploaded blogs
- View full blog details
- Edit and manage your posts

### Public Blog Listing
- All blogs are visible on the homepage
- Browse blogs from all users
- Click to view full blog content

---

## Technologies Used

- **Framework:** Laravel
- **Backend:** PHP
- **Database:** MySQL
- **Template Engine:** Blade Templates
- **Frontend:** HTML, CSS, Bootstrap

---

## Project Overview

This blog system provides a complete blogging platform with the following workflow:

1. **Registration & Login**
   - Users can register and log in to the system
   - Secure authentication ensures data protection

2. **Profile Management**
   - After login, users can update their profile details
   - Users can upload and change their profile picture

3. **Blog Creation**
   - Users can create blog posts with rich content
   - Image upload support for blog posts
   - Each user has a dedicated page showing only their own blogs

4. **Public Access**
   - All blogs appear on the public homepage
   - Anyone can browse and read blog posts
   - Clicking a blog opens the full blog view with complete details

---

## Installation

Follow these steps to set up the project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/Kabeer6568/Blog-System-Laravel.git
```

### 2. Navigate to Project Directory

```bash
cd Blog-System-Laravel
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Create Environment File

**Linux/Mac:**
```bash
cp .env.example .env
```

**Windows:**
```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Open the `.env` file and configure your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Create Storage Link (for image uploads)

```bash
php artisan storage:link
```

### 9. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

---

## Usage

### For Users

1. **Register an Account**
   - Navigate to the registration page
   - Fill in your details and create an account

2. **Login**
   - Use your credentials to log in

3. **Update Profile**
   - Go to your profile page
   - Update your information and profile picture

4. **Create Blog Posts**
   - Navigate to the create blog section
   - Write your content and upload images
   - Publish your blog

5. **View Your Blogs**
   - Access your dedicated blog page to see all your posts
   - Edit or manage your content

6. **Browse Blogs**
   - Visit the homepage to see all published blogs
   - Click on any blog to read the full content

---

## Project Structure

```
Blog-System-Laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
│   └── migrations/
├── public/
│   └── storage/
├── resources/
│   └── views/
│       └── (blade templates)
├── routes/
│   └── web.php
├── storage/
│   └── app/
│       └── public/
├── .env.example
├── composer.json
└── README.md
```

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Support

For issues, questions, or suggestions, please open an issue on the [GitHub repository](https://github.com/Kabeer6568/Blog-System-Laravel/issues).

---

## Author

**Kabeer**  
GitHub: [@Kabeer6568](https://github.com/Kabeer6568)

---

## Acknowledgments

- Laravel Framework
- Bootstrap
- All contributors and supporters

---

**Happy Blogging! 📝**
