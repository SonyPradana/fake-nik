<?php

declare(strict_types=1);

namespace Faker;

use Faker\Consts\JenisKelamin;
use Faker\Consts\Profinsi;
use Faker\Traits\UsiaTrait;

final class NIK
{
    use UsiaTrait;

    /** @var int */
    private $profinsi;

    /** @var int */
    private $kabupaten_kota;

    /** @var int */
    private $kecamatan;

    /** @var int */
    private $tanggal;

    /** @var int */
    private $bulan;

    /** @var int */
    private $tahun;

    /** @var int */
    private $gender;

    /** @var int[][][] */
    private $dbs;

    public function __construct(
        int $profinsi,
        int $kabupaten_kota,
        int $kecamatan,
        int $tanggal,
        int $bulan,
        int $tahun
    ) {
        $this->profinsi       = $profinsi;
        $this->kabupaten_kota = $kabupaten_kota;
        $this->kecamatan      = $kecamatan;
        $this->tanggal        = $tanggal;
        $this->bulan          = $bulan;
        $this->tahun          = $tahun;
        $this->gender         = JenisKelamin::LAKI;
        $this->dbs            = Profinsi::IDs();
    }

    public function __toString()
    {
        return $this->generate();
    }

    /**
     * @internal Helper method to fill text
     */
    private function fill(int $input, int $length = 2): string
    {
        $input      = (string) $input;
        $max_length = $length < \strlen($input) ? \strlen($input) : $length;
        $deviation  = $max_length - \strlen($input);

        if (0 === $deviation) {
            return $input;
        }

        return \str_repeat('0', $deviation) . $input;
    }

    /**
     * @internal Helper method to fill text
     */
    private function randMonth(int $month, int $year): int
    {
        if (in_array($month, [1, 3, 5, 7, 8, 10, 12])) {
            return rand(1, 31);
        }

        if (in_array($month, [4, 6, 9, 11])) {
            return rand(1, 31);
        }

        if ((0 == $year % 4) && (0 != $year % 100) || (0 == $year % 400)) {
            return rand(1, 28);
        }

        return rand(1, 29);
    }

    private function randProfinsi(): int
    {
        return (int) array_rand($this->dbs);
    }

    private function randKabupatenKota(): int
    {
        return (int) array_rand($this->dbs[$this->profinsi]);
    }

    private function randKecamatan(): int
    {
        return (int) array_rand($this->dbs[$this->profinsi][$this->kabupaten_kota]);
    }

    public function randAll(): self
    {
        $this->profinsi       = $this->randProfinsi();
        $this->kabupaten_kota = $this->randKabupatenKota();
        $this->kecamatan      = $this->randKecamatan();
        $this->tahun          = rand(1900, (int) date('Y'));
        $this->bulan          = rand(1, 12);
        $this->tanggal        = $this->randMonth($this->bulan, $this->tahun);

        return $this;
    }

    public function generate(): string
    {
        $profinsi       = $this->fill($this->profinsi);
        $kabupaten_kota = $this->fill($this->kabupaten_kota);
        $kecamatan      = $this->fill($this->kecamatan);
        $tanggal        = $this->gender === JenisKelamin::PEREMPUAN ? $this->tanggal + 40 : $this->tanggal;
        $tanggal        = $this->fill($tanggal);
        $bulan          = $this->fill($this->bulan);
        $tahun          = \substr((string) $this->tahun, -2);

        $index = rand(1, 50);
        $index = $this->fill($index, 4);

        return $profinsi . $kabupaten_kota . $kecamatan . $tanggal . $bulan . $tahun . $index;
    }

    public function jenisKelamin(int $gender): self
    {
        if (!in_array($gender, [JenisKelamin::LAKI, JenisKelamin::PEREMPUAN])) {
            throw new \Exception('Jenis kelamin hanya boleh laki-laki atau perempuan');
        }
        $this->gender = $gender;

        return $this;
    }

    public function profinsi(int $profinsi): self
    {
        if (!array_key_exists($profinsi, $this->dbs)) {
            throw new \Exception('Profinsi tidak ditemukan');
        }

        $this->profinsi       = $profinsi;
        $this->kabupaten_kota = $this->randKabupatenKota();
        $this->kecamatan      = $this->randKecamatan();

        return $this;
    }

    public function kabupatenKota(int $profinsi, int $kabKota): self
    {
        $this->profinsi($profinsi);
        if (!array_key_exists($kabKota, $this->dbs[$profinsi])) {
            throw new \Exception('Kabupaten atau kota tidak ditemukan');
        }

        $this->kabupaten_kota = $kabKota;
        $this->kecamatan      = $this->randKecamatan();

        return $this;
    }

    public function kecamatan(int $profinsi, int $kabKota, int $kecamatan): self
    {
        $this->profinsi($profinsi)->kabupatenKota($profinsi, $kabKota);

        if (!array_key_exists($kecamatan, $this->dbs[$profinsi][$kabKota])) {
            throw new \Exception('Kecamatan tidak ditemukan');
        }

        $this->kecamatan      = $kecamatan;

        return $this;
    }

    public function tahun(int $tahun): self
    {
        $this->tahun   = $tahun;
        $this->bulan   = rand(1, 12);
        $this->tanggal = $this->randMonth($this->bulan, $this->tahun);

        return $this;
    }

    public function date(\DateTimeInterface $dateTime): self
    {
        $this->tahun   = (int) $dateTime->format('Y');
        $this->bulan   = (int) $dateTime->format('m');
        $this->tanggal = (int) $dateTime->format('d');

        return $this;
    }
}
