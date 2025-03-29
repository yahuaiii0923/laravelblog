# Jellycat Chronicles 

<p align="center">
    <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/o/bashful-beige-bunny-banner__93776.original.jpg" alt="Jellycat Plushies" width="400" />
</p>

<p align="center">
    <img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/> 
    <img src="https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind"/> 
    <img src="https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
</p>

---

## 🧸 Project Overview  
A cozy Laravel blog celebrating Jellycat plushies! Features stories about:
- 25th Anniversary Collection 🎂  
- Halloween Amuseables 🎃  
- Bartholomew Bear & Bashful Bunny friendship 🐻🐰  
- Smudge Collection 🐘  

Special feature: **Plushie Matchmaker** - personality-based plushie recommendations!

---

## ✨ Key Features  
- **Interactive Comments** (Post, Like, Delete ❌)  
- **Plushie Matchmaker Quiz** 🧩  
- **SEO-Friendly Blog System**  
- **Responsive Design** with Tailwind CSS  
- **Image Handling** with Intervention Image  

---

## 🛠️ Installation

### 1. Clone the repo

```
git clone https://github.com/yahuaiii0923/laravelblog
```

### 2.Install Dependencies
```
# Install PHP packages (Laravel, Eloquent Sluggable, Intervention Image)
composer install

# Install JavaScript dependencies (Tailwind CSS, jQuery, etc.)
npm install
```

### 3. Set up the environment file
`.env` file is not included in the repository. You can create a new one by copying the example file.
```
cp .env.example .env
```
Generate a new application key.
```
php artisan key:generate
```

### 4. Set up the database
This project uses MySQL. Create a new database and update the `.env` file with your database credentials.
Replace `{your_database_name}`, `{your_username}`, and `{your_password}` with your own information.
DB_USERNAME and DB_PASSWORD are the credentials for your MySQL database, usually set as root and an empty password by default.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={your_database_name}
DB_USERNAME={your_username}
DB_PASSWORD={your_password}
``` 

### 5. Run the migrations
```
php artisan migrate --seed
```

### 6. Serve the application
Run the following command to start the Laravel development server.
```
php artisan serve
```

