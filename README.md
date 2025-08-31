			Gallery Café 
--------------------------------------------------------------------

A full-stack web application** for managing restaurant operations, built with **PHP, MySQL, HTML, CSS, and JavaScript**.  
The system supports **role-based access** for Customers, Staff, and Admins, making it a complete restaurant management solution.  

---

🚀 Features

👨‍🍳 Customer (User)
- Browse menu items  
- Reserve a table  
- Pre-order meals  
- Reserve a parking spot  
- View events & promotions  
- Create & manage an account (register, login, edit profile)  
- Write reviews (displayed on homepage)  
- Send messages to the restaurant  
- Search for meals  

👔 Staff
- Manage meal items (add / edit / delete)  
- Manage promotions & events  
- Manage pre-orders  
- Manage table reservations  
- Manage parking reservations  

👑 Admin
- Add/remove admins and staff members  
- Read & delete customer reviews 
- Read & delete messages  
- Manage all user accounts 

---

🛠 Tech Stack
- Frontend: HTML, CSS, JavaScript  
- Backend: PHP  
- Database: MySQL (via phpMyAdmin)  

---

⚙️ Installation & Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/AkifHamzi/gallery-cafe.git
Move project files into your XAMPP htdocs folder 

Import the database:

Open phpMyAdmin

Create a new database (e.g., gallery_cafe_db)

Import the provided database file

Configure database connection in config.php:

<?php

$db_name = "mysql:host=localhost;dbname=gallery_cafe_db";
$username = "root";
$password = "";

$conn = new PDO($db_name, $username, $password);


http://localhost/thegallerycafe/thegallerycafe/home.php


👨‍💻 Author
Developed by Akif Ali
📧 akifali_@outlook.com
🔗 https://github.com/AkifHamzi