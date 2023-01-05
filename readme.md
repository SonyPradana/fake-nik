## Faker Nik (Nomor Induk Kepedendudukan)
Generate fake nik with valid data, and can be controlled.

## Using
using helpers
```php
fakeNIK()->generate();
// 3212135412780001 (16 digit random nik)
```

### controll faker
```php
fakeNIK()
    ->jenisKelamin(JenisKelamin::Laki)
    ->profinsi(Proffinsi::JAWA_TENGAH)
    ->usia(17)
    ->generate();
// 3324140506980002 (controll your faker)
```

### Todo
- [] add more tests
- [] support generating 'kabupaten/kota' levels.
- [] support generating 'kelurahan' levels.
