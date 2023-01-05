<?php

declare(strict_types=1);

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
        $nik = $this->nik->randALl()->generate();

        $this->assertEquals(16, \strlen($nik));
    }

    /** @test */
    public function itCanGenerateNIKProfinsi()
    {
        $niks = [];
        foreach (range(1, 100) as $item) {
            $niks[] = $this->nik
                ->randALl()
                ->profinsi(Profinsi::JAWA_TENGAH)
                ->generate();
        }

        foreach ($niks as $nik) {
            $this->assertContainString($nik, '33');
        }
    }

    /** @test */
    public function itCanGenerateNIKTahun()
    {
        $nik = $this->nik->randALl()->tahun(2022)->generate();

        $this->assertContainString($nik, '22');
    }
}
