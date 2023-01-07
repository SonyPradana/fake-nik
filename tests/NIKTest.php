<?php

declare(strict_types=1);

use Faker\Consts\JenisKelamin;
use Faker\Consts\Profinsi;
use Faker\NIK;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class NIKTest extends TestCase
{
    /**
     * @var NIK
     */
    private $nik;

    protected function setUp(): void
    {
        $this->nik = new NIK(0, 0, 0, 0, 0, 0, 0, 0);
    }

    protected function tearDown(): void
    {
        $this->nik = null;
    }

    private function assertContainString(string $haystack, string $needle): void
    {
        Assert::assertTrue(false !== strpos($haystack, $needle));
    }

    /** @test */
    public function itCanGenerateNik()
    {
        $nik = $this->nik->randAll()->generate();

        $this->assertEquals(16, \strlen($nik));
    }

    /** @test */
    public function itCanGenerateNIKProfinsi()
    {
        $niks = [];
        foreach (range(1, 100) as $item) {
            $niks[] = $this->nik
                ->randAll()
                ->profinsi(Profinsi::JAWA_TENGAH)
                ->generate();
        }

        foreach ($niks as $nik) {
            $this->assertContainString($nik, '33');
        }
    }

    /** @test */
    public function itCanGenerateNIKKabupatenKota()
    {
        $nik = $this->nik
            ->randAll()
            ->kabupatenKota(Profinsi::JAWA_TENGAH, 24)
            ->generate();

        $this->assertContainString($nik, '3324');
    }

    /** @test */
    public function itCanGenerateNIKKecamatan()
    {
        $nik = $this->nik
            ->randAll()
            ->kecamatan(Profinsi::JAWA_TENGAH, 24, 12)
            ->generate();

        $this->assertContainString($nik, '332412');
    }

    /** @test */
    public function itCanGenerateNIKTahun()
    {
        $nik = $this->nik->randAll()->tahun(2022)->generate();

        $this->assertContainString($nik, '22');
    }

    /** @test */
    public function itCanGenerateNIKUsingDate()
    {
        $nik = $this->nik->randAll()->jenisKelamin(JenisKelamin::LAKI)->date(new \DateTime('12-12-2015'))->generate();
        $this->assertContainString($nik, '121215');
    }
}
