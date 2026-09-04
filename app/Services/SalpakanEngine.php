<?php

namespace App\Services;

class SalpakanEngine
{
    protected array $hierarchy = [
        '5SG' => 15, '4SG' => 14, '3SG' => 13, '2SG' => 12, '1SG' => 11,
        'Col' => 10, 'LC'  => 9,  'Maj' => 8,  'Cap' => 7,  '1Li' => 6,
        '2Li' => 5,  'Sgt' => 4,  'Prv1' => 3, 'Prv2' => 3, 'Prv3' => 3,
        'Prv4' => 3, 'Prv5' => 3, 'Prv6' => 3, 'Spy1' => 2, 'Spy2' => 2, 'Flg' => 1,
    ];

    public function resolveCombat(string $attackerRank, string $defenderRank): string
    {
        // Clean rank prefixes (e.g. 'P15SG' -> '5SG')
        $att = preg_replace('/^P[12]/', '', $attackerRank);
        $def = preg_replace('/^P[12]/', '', $defenderRank);

        if ($att === 'Flg' && $def === 'Flg') return 'attacker';
        if ($att === 'Flg') return 'defender';
        if ($def === 'Flg') return 'attacker';

        // Spy vs Private mechanic
        if ($att === 'Spy' && str_contains($def, 'Prv')) return 'defender';
        if (str_contains($att, 'Prv') && $def === 'Spy') return 'attacker';

        // Spy vs Officers
        if (str_contains($att, 'Spy')) return 'attacker';
        if (str_contains($def, 'Spy')) return 'defender';

        $attVal = $this->hierarchy[$att] ?? 0;
        $defVal = $this->hierarchy[$def] ?? 0;

        if ($attVal > $defVal) return 'attacker';
        if ($defVal > $attVal) return 'defender';

        return 'both';
    }

    public function isValidMove(int $startX, int $startY, int $endX, int $endY): bool
    {
        $dx = abs($endX - $startX);
        $dy = abs($endY - $startY);

        return ($dx === 1 && $dy === 0) || ($dx === 0 && $dy === 1);
    }
}