<p align="center">
    <img src="https://raw.githubusercontent.com/sonypradana/fake-nik/main/art/logo.png" height= 300 alt="fake nik logo">
    <p align="center">
        <a href="https://packagist.org/packages/sonypradana/fake-nik"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/sonypradana/fake-nik"></a>
        <a href="https://github.com/sonypradana/fake-nik/actions"><img alt="Start" src="https://img.shields.io/github/stars/SonyPradana/fake-nik"></a>
        <a href="https://github.com/SonyPradana/fake-nik/actions/workflows/tests.yml"><img alt="test past" src="https://github.com/SonyPradana/fake-nik/actions/workflows/tests.yml/badge.svg"></a>
        <a href="https://github.com/SonyPradana/fake-nik/blob/main/LICENSE.md"><img alt="License" src="https://img.shields.io/github/license/SonyPradana/fake-nik"></a>
    </p>
</p>

------

## Faker Nik (Nomor Induk Kepedendudukan)
Generate fake nik with valid data, and can be controlled.

## Install
using composer
```bash
composer require sonypradana/fake-nik --dev
```
## Using
using helpers
```php
fakeNIK()->generate();
// 3212135412780001 (16 digit random nik)
```

### controlled faker
```php
fakeNIK()
    ->jenisKelamin(JenisKelamin::Laki)
    ->profinsi(Proffinsi::JAWA_TENGAH)
    ->usia(17)
    ->generate();
// 3324140501060002 (controll your faker)

fakeNIK()
    ->jenisKelamin(JenisKelamin::LAKI)
    ->date(new \DateTime('12-12-2012'))
    ->generate();
// 3424141212120018 (controll your faker)
```

## Todo
- [ ] add more tests
- [ ] support generating 'kabupaten/kota' levels.
- [ ] support generating 'kelurahan' levels.

`fake-nik` is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
