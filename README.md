# 🏆 LAMP Judging System  
A complete competition judging platform built on the LAMP stack with secure role-based access control.

---

## ✨ Features

### 🔐 Admin Panel  
- 👨‍💼 Manage judges & participants  
- 📊 View scoring analytics  

### 🧑‍⚖️ Judge Portal  
- ✏️ Submit scores (1–100 scale)  
- ❌ Duplicate scoring prevention  

### 📺 Public Scoreboard  
- 🔄 Auto-refreshing every 10 seconds  
- 🏆 Visual podium highlighting  

---

## 🛠️ Tech Stack

| Component  | Technology             |
|------------|------------------------|
| Frontend   | HTML5, CSS3, JavaScript|
| Backend    | PHP 8.1+               |
| Database   | MySQL 5.7+             |
| Security   | Password hashing       |

---

## 🚀 Installation Guide

### Local Development (XAMPP)

1. **Install XAMPP**  
   Download from [Apache Friends](https://www.apachefriends.org/)

2. **Clone Repository**  
   ```bash
   git clone https://github.com/yourusername/judging-system.git
   cp -r judging-system /opt/lampp/htdocs/
   ```

3. **Database Setup**  
   ```bash
   mysql -u root -p < /opt/lampp/htdocs/judging-system/database/schema.sql
   ```

4. **Configure Database**
   Edit `/opt/lampp/htdocs/judging-system/config/database.php`
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'judging_system');
   ```

---

## 🗃️ Database Schema

```sql
-- Users Table
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) UNIQUE NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','judge') NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Participants Table
CREATE TABLE `participants` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(50),
  PRIMARY KEY (`id`)
);

-- Scores Table
CREATE TABLE `scores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `judge_id` INT NOT NULL,
  `participant_id` INT NOT NULL,
  `score` INT NOT NULL CHECK (score BETWEEN 1 AND 100),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_judging` (`judge_id`, `participant_id`),
  FOREIGN KEY (`judge_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`participant_id`) REFERENCES `participants`(`id`)
);
```

---

## 🔑 Access Guide

| Role      | Access URL                 | Demo Credential         |
|-----------|----------------------------|--------------------------|
| Admin     | /Admin/landing.php`         | `admin / AdminPass123!` |
| Judge     | `/Judge/dashboard.php`     | `judge1 / JudgePass123!`|
| Public    | `/Public/score_board.php`   | Open access             |

---

## 🧠 Development Decisions

### Why PDO?
- ✅ Prepared statements prevent SQL injection  
- ✅ Database-agnostic compatibility

### Why Session Authentication?
- ✅ Simpler than JWT for server-side apps  
- ✅ Built-in support in PHP

### Why No JavaScript Framework?
- ✅ Vanilla JS is sufficient  
- ✅ Faster page loads, no framework overhead  

---

## 🛣️ Future Roadmap

### 🔧 Enhanced Features
- Password recovery system  
- Score dispute resolution  
- Bulk participant import (CSV)

### ⚙️ Technical Improvements
- Dockerized deployment  
- REST API endpoints  
- WebSocket live updates

### 🎨 UI/UX Upgrades
- Dark mode toggle  
- Score distribution charts  
- Judge comment system  

---

## ⚠️ Troubleshooting

### Problem: Database connection fails  
**Solution:**  
```bash
sudo systemctl restart mysql
# Verify credentials in config/database.php
```

### Problem: Permission denied errors  
**Solution:**  
```bash
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 storage/
```

### Problem: Form submissions blocked  
**Solution:**  
- Check CSRF tokens  
- Ensure method="POST" is used  
- Verify input `name` attributes match backend expectations  
