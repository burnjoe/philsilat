<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 📘 Requirements
Make sure you have installed the following:
- [Visual Studio Code](https://code.visualstudio.com/download)
- [XAMPP](https://www.apachefriends.org/download.html)
- [NodeJS](https://nodejs.org/en/download/)
- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/downloads)
- [GitHub Desktop](https://desktop.github.com/) (Optional)

## 🔧 Installation
### Starting XAMPP Server
1. Open XAMPP Control Panel
2. Start *Apache* & *MySQL* servers
3. Search *http://localhost/phpmyadmin* in any browser
4. Create new database and name it *'philsilat'*
5. Clone the repository with [CLI](#cloning-repository-with-cli) or [GitHub Desktop](#cloning-repository-with-github-desktop)

<br>

### Cloning Repository with CLI
1. Open Visual Studio Code
2. Choose a folder where you want to clone the repository in *File > Open Folder*
3. Open Visual Studio Code terminal *(Ctrl + `)* and enter the following commands:

Clone the repository
```
git clone https://github.com/burnjoe/philsilat.git
```

Change terminal directory
```
cd philsilat
```

<br>

### Cloning Repository with GitHub Desktop
1. Open GitHub Desktop
2. Clone the repository in *File > Clone Repository*

Select URL tab and paste the following:
```
https://github.com/burnjoe/philsilat.git
```

3. Choose a folder where you want to clone the repository and then *Clone*
4. Open the cloned repository in Visual Studio Code in *Repository > Open in Visual Studio Code*

<br>

### Adding All Dependencies and Setting Up the Project

#### Open Visual Studio Code terminal *(Ctrl + `)* and enter the following commands:

Install composer to the project
```
composer install
```

Install npm to the project
```
npm install
```

Create .env 
```
copy .env.example .env
```

Generate new app key
```
php artisan key:generate
```

Run the migration and seed
```
php artisan migrate:fresh --seed
```


## ⚡ Running the Server

#### Enter these following commands to your terminal:

Start local development server for your laravel app
```
php artisan serve
```

Open new terminal and start local development server for node
```
npm run dev
```


### ✨ You can now access the server at http://localhost:8000