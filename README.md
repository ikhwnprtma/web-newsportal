<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# DOKUMENTASI API NEWS PORTAL

Dokumentasi ini menjelaskan tentang spesifikasi API pada layanan News Portal

## Base URL

http://localhost:8000/api/

## Endpoints

### GET /category

Endpoint ini untuk mendapatkan daftar kategori berita

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": [
        {
            "id": 1,
            "nama": "Olahraga",
            "slug": "Olahraga"
        }
    ]
}
```

- status: 404 (Data Not Found)
- Body

```json
{
    "status": false,
    "message": "Data tidak ditemukan"
}
```

### GET /category/{id}

Endpoint ini untuk mendapatkan detail dari kategori

#### Parameter (PATH)

- id: integer (id kategori)

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": {
        "id": 1,
        "nama": "Olahraga",
        "slug": "Olahraga"
    }
}
```

- status: 404 (Data Not Found)
- Body

```json
{
    "status": false,
    "message": "Data tidak ditemukan"
}
```

### POST /category

Endpoint ini untuk menambah kategori baru

#### Request Body

```json
{
    "nama": "Pendidikan"
}
```

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": {
        "id": 2,
        "nama": "Pendidikan",
        "slug": "Pendidikan"
    }
}
```

### PUT /category/{id}

Endpoint ini untuk memperbarui kategori terpilih

#### Parameter (PATH)

- id: integer (id kategori)

#### Request Body

```json
{
    "nama": "Pendidikan"
}
```

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": {
        "id": 2,
        "nama": "Pendidikan",
        "slug": "Pendidikan"
    }
}
```

### DELETE /category/{id}

Endpoint ini untuk menghapus kategori terpilih

#### Parameter (PATH)

- id: integer (id kategori)

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": {
        "id": 2,
        "nama": "Pendidikan",
        "slug": "Pendidikan"
    }
}
```
### GET /news

Endpoint ini untuk mendapatkan daftar berita.

#### Response

- Status: 200(OK)
- Body

```json
{
    "success": true,
    "message": "Berhasil",
    "data": {
        "id": 1,
        "title": "Judul Berita",
        "slug": "judul-berita",
        "content": "Isi berita lengkap",
        "image": "image.jpg",
        "user_id": 1,
        "category_id": 2,
    }
}
```

- status: 404 (Data Not Found)
- Body

```json
{
    "status": false,
    "message": "Data tidak ditemukan"
}
```

### GET /news/{id}

Endpoint ini untuk mendapatkan detail dari news

#### Parameter (PATH)

- id: integer (id news)

#### Response

- Status: 200 (OK)
- Body

```json
{
    "success": true,
    "message": "Berhasil",
    "data": {
        "id": 1,
        "title": "Judul Berita",
        "slug": "judul-berita",
        "content": "Isi berita lengkap",
        "image": "image.jpg",
        "user_id": 1,
        "category_id": 2,
    }
}
```

- status: 404 (Data Not Found)
- Body

```json
{
    "status": false,
    "message": "Data tidak ditemukan"
}
```

### POST /news

Endpoint ini untuk menambah news baru

#### Request Body

```json
{
    "title": "Judul Berita",
    "slug": "judul-berita",
    "content": "Isi berita",
    "image": "image.jpg",
    "user_id": 1,
    "category_id": 2
}
```

#### Response

- Status: 200 (OK)
- Body

```json
{
    "success": true,
    "message": "Berhasil",
    "data": {
        "id": 1,
        "title": "Judul Berita",
        "slug": "judul-berita",
        "content": "Isi berita",
        "image": "image.jpg",
        "user_id": 1,
        "category_id": 2,
    }
}
```

### PUT /news/{id}

Endpoint ini untuk memperbarui news yang terpilih

#### Parameter (PATH)

- id: integer (id news)

#### Request Body

```json
{
    "title": "Judul Berita Update",
    "slug": "judul-berita-update",
    "content": "Isi berita terbaru",
    "image": "image-new.jpg",
    "user_id": 1,
    "category_id": 3
}
```

#### Response

- Status: 200 (OK)
- Body

```json
{
    "success": true,
    "message": "Berhasil",
    "data": {
        "id": 1,
        "title": "Judul Berita Update",
        "slug": "judul-berita-update",
        "content": "Isi berita terbaru",
        "image": "image-new.jpg",
        "user_id": 1,
        "category_id": 3,
    }
}
```

### DELETE /news/{id}

Endpoint ini untuk menghapus news yang terpilih

#### Parameter (PATH)

- id: integer (id news)

#### Response

- Status: 200 (OK)
- Body

```json
{
    "status": true,
    "message": "Berhasil",
    "data": {
        "title": "Judul Berita",
        "slug": "judul-berita",
        "content": "Isi berita",
        "image": "image.jpg",
        "user_id": 1,
        "category_id": 2
    }
}
```