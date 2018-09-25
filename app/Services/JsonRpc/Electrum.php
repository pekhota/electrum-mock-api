<?php

namespace App\Services\JsonRpc;


class Electrum
{
    public function getbalance() {
        return [
            'confirmed' => getenv('ELECTRUM_BALANCE')
        ];
    }

}