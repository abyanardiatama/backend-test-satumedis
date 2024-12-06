# Case Study: Product Management API

Proyek ini adalah sebuah aplikasi sederhana berbasis API untuk menunjukkan kemampuan dalam menangani autentikasi, proses CRUD, pencarian data, validasi input, dan paginasi. API ini dirancang untuk memenuhi persyaratan studi kasus berikut.

## Fitur Utama

1. **Authentication**:
   - API hanya dapat diakses menggunakan **JWT Token**.
   - Dummy/sample akun dapat digunakan untuk login.

2. **CRUD (Create, Read, Update, Delete)**:
   - Mengelola data produk melalui proses CRUD.
   - Data tidak boleh duplikat (validasi unik diterapkan).

3. **Data Search & Validation**:
   - Fitur pencarian berdasarkan nama atau harga produk.
   - Validasi input untuk memastikan data yang masuk sesuai spesifikasi.

4. **Data Pagination**:
   - Mendukung paginasi untuk memudahkan pengelolaan data besar.

## Persyaratan

- API hanya dapat diakses dengan autentikasi JWT Token.
- Data produk tidak boleh duplikat.
- Validasi tambahan diterapkan untuk memastikan integritas data.

## Dokumentasi API

### **Autentikasi**
1. **Register**
   - Endpoint: `POST /auth/register`
   - Input:
     ```json
     {
       "email": "abyan@mail.com",
       "password": "password"
     }
     ```
   - Validasi:
     - 'name' => 'required|string|max:255',
     - 'email' => 'required|string|email:rfc,dns|max:255|unique:users',
     - 'password' => 'required|string|min:6',
   - Output:
     ```json
     {
       "access_token": "your-jwt-token",
       "token_type": "bearer",
       "expires_in": 3600
     }
     ```
2. **Login**
   - Endpoint: `POST /auth/login`
   - Input:
     ```json
     {
       "email": "abyan@mail.com",
       "password": "password"
     }
     ```
   - Output:
     ```json
     {
       "access_token": "your-jwt-token",
       "token_type": "bearer",
       "expires_in": 3600
     }
     ```

3. **Logout**
   - Endpoint: `POST /auth/logout`
   - Header: `{ Authorization: Bearer your-jwt-token }`
   - Output:
     ```json
     {
       "message": "Successfully Logged out"
     }
     ```

### **CRUD Produk**
1. **Create Product**
   - Endpoint: `POST /auth/products`
   - Input:
     ```json
     {
       "name": "Product Name",
       "description" : "This is product description",
       "price": 100,
       "stock": 10
     }
     ```
   - Validasi:
     - Nama produk unik.
     - Harga produk angka minimal 0.
   - Output:
     ```json
     {
       "status": "success",
       "message": "Product created successfully",
       "data": {
         "name": "Product Name",
         "description": "This is product description",
         "price": 100,
         "stock": 10,
         "updated_at": "2024-12-06T06:56:29.000000Z",
         "created_at": "2024-12-06T06:56:29.000000Z",
         "id": 1
       }
     }
     ```

2. **Read Product (List)**
   - Endpoint: `GET /auth/products?per_page=5&page=1`
   - Output:
     ```json
     {
       "data": [
         {
           "id": 1,
           "name": "Product Name",
           "description": "This is product description",
           "price": 100,
           "stock": 10,
           "updated_at": "2024-12-06T06:56:29.000000Z",
           "created_at": "2024-12-06T06:56:29.000000Z"
         }
       ],
       "pagination": {
         "current_page": 1,
         "per_page": 5
       }
     }
     ```

3. **Search Product**
   - Endpoint: `GET /auth/products/search`
   - Input:
     - Parameter opsional: `name`, `price`, `per_page`.
   - Output:
     ```json
     {
       "data": [
         {
           "id": 1,
           "name": "Product Name",
           "description": "This is product description",
           "price": 100,
           "stock": 10,
           "updated_at": "2024-12-06T06:56:29.000000Z",
           "created_at": "2024-12-06T06:56:29.000000Z"
         }
       ]
     }
     ```

4. **Update Product**
   - Endpoint: `PUT /auth/products/{id}`
   - Input:
     ```json
     {
       "name": "Updated Name",
       "description": "Updated product description",
       "price": 200,
       "stock": 25
     }
     ```
   - Output:
     ```json
     {
       "status": "success",
       "message": "Product updated successfully",
       "data": {
         "id": 1,
         "name": "Updated Product Name",
         "description": "Updated product description",
         "price": 150,
         "stock": 25,
         "created_at": "2024-12-05T20:33:51.000000Z",
         "updated_at": "2024-12-05T22:01:02.000000Z"
       }
     }
     ```

5. **Delete Product**
   - Endpoint: `DELETE /auth/products/{id}`
   - Output:
     ```json
     {
       "status": "success",
       "message": "Product deleted successfully"
     }
     ```

## Langkah Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/abyanardiatama/backend-test-satumedis.git
   cd backend-test-satumedis

2. Install Dependensi
   ```bash
   composer install

3. Setup Environment File
   ```bash
   cp .env.example .env
   ```
   Kemudian buka file .env dan sesuaikan konfigurasi berikut untuk menggunakan database SQLite:
   ```bash
   DB_CONNECTION=sqlite
   ```
   
4. Generate App Key
   ```bash
   php artisan key:generate
   
5. Jalankan Migrasi Database dan Seeding
   ```bash
   php artisan migrate:fresh --seed

6. Menjalankan Server
   ```bash
   php artisan serve
Server akan berjalan di http://localhost:8000. Anda dapat mengakses aplikasi di browser menggunakan alamat tersebut.
