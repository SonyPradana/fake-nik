<?php

declare(strict_types=1);

namespace Faker\Traits;

trait UsiaTrait
{
    public function usia(int $usia): self
    {
        $this->tahun = (int) date('Y') - $usia;

        return $this;
    }

    public function usiaDiatas(int $usia): self
    {
        $year        = (int) date('Y') - $usia;
        $this->tahun = rand(1990, $year);

        return $this;
    }

    public function usiaDibawah(int $usia): self
    {
        $year        = (int) date('Y') - $usia;
        $this->tahun = rand($year, (int) date('Y'));

        return $this;
    }

    public function usiaDiantara(int $min, int $mak): self
    {
        $year_min         = (int) date('Y') - $min;
        $year_maks        = (int) date('Y') - $mak;
        $this->tahun      = rand($year_min, $year_maks);

        return $this;
    }
}
