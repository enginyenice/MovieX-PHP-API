# MovieX-PHP-API

## Paket bağımlılıklarının yüklenmesi
```composer install```

## Veritabanı kurulumu
Database klasörü içerisinde bulunan ```enginpyx_moviex.sql``` sql dosyasını Mysql tarafına yüklenmelidir.

```Libraries/Database.php``` içerisinde bulunan  __construct() gerekli şekilde düzenlenmelidir.

```
        $this->user = "root"; // Veritabanı Kullanıcı Adı
        $this->host = "localhost"; // Veritabanı URL
        $this->pass = ""; // Veritabanı Şifresi
        $this->db = "movieXDatabase"; // Veritabanı Adı
```

## OMDB API Anahtarının düzenlenmesi
```Libraries/Movies.php``` içerisinde bulunan __construct() gerekli şekilde düzenlenmelidir.

```
$this->apiUrl = "http://www.omdbapi.com/?apikey={API Anahtarı}";
```

## [MovieX API Kodları](https://github.com/enginyenice/MovieX-Mobil-App-Ionic-Angular)
