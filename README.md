<h1><p align="center">Laravel 8, SpaceX API, Laravel Passport, Swagger </p></h1>

<p align="center">
<h3>
    Projenin Heroku Adresi : https://vast-sands-21729.herokuapp.com/api/documentation
</h3>
</p>

## Projede ki API'lerin testi için

- Register ile post istegi gönderip kayıt işlemi tamamlanmalı.
- Kayıt olunan Mail ve şifreyle giriş yapılmalı. Dönen response verisindeki token kopyalanmalı ve Authorize'a eklenmeli.
- Auth işlemi tamamlandıktan sonra diğer GET isteklerini kullanabilirsiniz.

## Proje Clone işlemi ve Gerekli paketlerin kurulumu

Projeyi reposunu git ile kendi localinize klonladıktan sonra;

- composer install ile paketler yüklenmeli.
- Authentication işlemleri için Laravel passport paketi kurulmalı
- Özel oluşturulan "php artisan send:data" komutu sayesinde event listener çalıştırılır.
- php artisan schedule:work komutunu çalıştırdıktan sonra her 3 dakikada özel komut "php artisan send:data" çalışır, admin kullanıcıya mail gönderilir ve Spacex API si ile veritabanı senkronizasyonu sağlanır.
- Authentication işlemleri için Laravel passport paketi kurulmalı
- Swagger ile API dökümantasyonu kurulumu için https://github.com/DarkaOnLine/L5-Swagger adresinden yararlanabilirsiniz.
- Swagger dökümantasyonunu aktif etmek için php artisan l5-swagger:generate komutu calıstırılmalı
- Swagger dökümantasyonuna ulaşmak için php artisan serve yazıldıktan sonra http://localhost:8000/api/documentation adresinden ulasilabilir.

## SpaceX API

- Tüm Kapsüller API'si : https://api.spacexdata.com/v3/capsules
- Kapsül durumuna göre API : https://api.spacexdata.com/v3/capsules?status=active
- Seri numarasına göre API : https://api.spacexdata.com/v3/capsules/C112

## Projenin Endpointleri

    Projede yazılan endpointler Repository Pattern kullanılarak yazılmıştır.
    Projede Event Listener kullanılmıştır.

- User Register API (POST): http://localhost:8000/api/register
- User Login API (POST): http://localhost:8000/api/login
- User Logout API (GET): http://localhost:8000/api/logout
- Tüm Kapsüller API'si (GET): http://localhost:8000/api/capsules
- Kapsül durumuna göre API (GET): http://localhost:8000/api/capsules?status=active|retired|unknown|etc
- Seri numarasına göre API (GET): http://localhost:8000/api/capsules/{capsule_serial}

### Pojenin Ekran Çıktıları
<details>
<summary>Swagger</summary>
<img src="https://user-images.githubusercontent.com/56219956/145467380-64a0d2a5-d1d0-4c7c-ba7e-d4b00088641f.png" width="500">
</details>
<details>
<summary>Log</summary>
<img src="https://user-images.githubusercontent.com/56219956/145467413-01483b5c-4670-4b33-9f4c-ced8f59c98bd.png" width="500">
</details>
<details>
<summary>Mail</summary>
<img src="https://user-images.githubusercontent.com/56219956/145467438-825ee0bd-69d5-4f65-8cae-6156108c9cad.png" width="500">
</details>
<details>
<summary>Sync</summary>
<img src="https://user-images.githubusercontent.com/56219956/145467449-fbed029d-c30b-4018-be31-6b9401f6f99f.png" width="500">
</details>

