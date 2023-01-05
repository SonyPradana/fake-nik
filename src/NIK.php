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

    public function randALl(): self
    {
        $rand_id              = array_rand(Profinsi::IDs());
        $this->profinsi       = Profinsi::IDs()[$rand_id];
        $this->kabupaten_kota = rand(1, 50);
        $this->kecamatan      = rand(1, 50);
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
        $this->profinsi = $profinsi;

        return $this;
    }

    public function tahun(int $tahun): self
    {
        $this->tahun   = $tahun;
        $this->bulan   = rand(1, 12);
        $this->tanggal = $this->randMonth($this->bulan, $this->tahun);

        return $this;
    }
}
