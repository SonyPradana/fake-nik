<?php

declare(strict_types=1);

namespace Faker\Consts;

final class Profinsi
{
    public const ACEH                       = 11;
    public const SUMATERA_UTARA             = 12;
    public const SUMATERA_BARAT             = 13;
    public const RIAU                       = 14;
    public const JAMBI                      = 15;
    public const SUMATERA_SELATAN           = 16;
    public const BENGKULU                   = 17;
    public const LAMPUNG                    = 18;
    public const KEPULAUAN_BANGKA_BELITUNG  = 19;
    public const KEPULAUAN_RIAU             = 21;
    public const DKI_JAKARTA                = 31;
    public const JAWA_BARAT                 = 32;
    public const JAWA_TENGAH                = 33;
    public const DAERAH_ISTIMEWA_YOGYAKARTA = 34;
    public const JAWA_TIMUR                 = 35;
    public const BANTEN                     = 36;
    public const BALI                       = 51;
    public const NUSA_TENGGARA_BARAT        = 52;
    public const NUSA_TENGGARA_TIMUR        = 53;
    public const KALIMANTAN_BARAT           = 61;
    public const KALIMANTAN_TENGAH          = 62;
    public const KALIMANTAN_SELATAN         = 63;
    public const KALIMANTAN_TIMUR           = 64;
    public const KALIMANTAN_UTARA           = 65;
    public const SULAWESI_UTARA             = 71;
    public const SULAWESI_TENGAH            = 72;
    public const SULAWESI_SELATAN           = 73;
    public const SULAWESI_TENGGARA          = 74;
    public const GORONTALO                  = 75;
    public const SULAWESI_BARAT             = 76;
    public const MALUKU                     = 81;
    public const MALUKU_UTARA               = 82;
    public const PAPUA                      = 91;
    public const PAPUA_BARAT                = 92;

    /** @return int[] */
    public static function IDs(): array
    {
        return [
            11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 31,
            32, 33, 34, 35, 36, 51, 52, 53, 61, 62, 63,
            64, 65, 71, 72, 73, 74, 75, 76, 81, 82, 91,
            92,
        ];
    }
}
