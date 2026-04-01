# 🚀 Portfolio Backend API (Laravel)

## 📌 Overview

Backend API untuk aplikasi portfolio project menggunakan Laravel.

Fitur utama:

* Authentication (Register, Login, Logout)
* Role-based access (Admin only)
* CRUD Project
* Pagination, Search, Filter, Sorting
* API Versioning (v1)
* Rate Limiting & Security

---

## 🔗 Base URL

```
http://127.0.0.1:8000/api/v1
```

---

## 🔐 Authentication

Menggunakan Laravel Sanctum (Token-based)

### Register

**POST** `/register`

Body:

```json
{
  "name": "Admin",
  "email": "admin@mail.com",
  "password": "123456"
}
```

---

### Login

**POST** `/login`

Body:

```json
{
  "email": "admin@mail.com",
  "password": "123456"
}
```

Response:

```json
{
  "success": true,
  "message": "Login berhasil.",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@mail.com",
      "role": "admin"
    },
    "token": "YOUR_TOKEN"
  }
}
```

---

### Logout

**POST** `/logout`

Header:

```
Authorization: Bearer YOUR_TOKEN
```

---

## 📦 Project API (Admin Only)

Semua endpoint butuh:

```
Authorization: Bearer YOUR_TOKEN
```

---

### 📄 Get All Projects

**GET** `/projects`

Query:

* `search` → cari title
* `tech_stack` → filter
* `sort=latest|oldest`
* `page`
* `per_page`

Contoh:

```
/projects?search=laravel&per_page=5&page=1
```

---

### 📄 Get Detail Project

**GET** `/projects/{id}`

---

### ➕ Create Project

**POST** `/projects`

Body:

```json
{
  "title": "Website Portfolio",
  "description": "Project Laravel API",
  "tech_stack": "Laravel, MySQL"
}
```

---

### ✏️ Update Project

**PUT** `/projects/{id}`

---

### ❌ Delete Project

**DELETE** `/projects/{id}`

---

## ⚠️ Error Response

### 404 Not Found

```json
{
  "success": false,
  "message": "Data tidak ditemukan."
}
```

### 422 Validation Error

```json
{
  "success": false,
  "message": "Validasi gagal.",
  "errors": {
    "title": ["The title field is required."]
  }
}
```

### 401 Unauthorized

```json
{
  "success": false,
  "message": "Unauthorized."
}
```

---

## 🛡 Security

* Authentication via Bearer Token
* Rate limiting (login & API)
* Role-based access (admin only)

---

## 🧠 Tech Stack

* Laravel 11
* MySQL
* Laravel Sanctum

---

## 👨‍💻 Author

Fahril Ilham Pangestu
Backend Developer (Laravel)
