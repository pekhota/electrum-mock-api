<?php

namespace App\Services\JsonRpc;


class Electrum
{
    public function getbalance() {
        return [
            'confirmed' => getenv('ELECTRUM_BALANCE')
        ];
    }

    private $validationRules = [
        'getaddressbalance' => [
            'params.address' => 'required'
        ],
        'addrequest' => [
            'params.amount' => 'required',
            'params.memo' => 'string',
            'params.force' => 'boolean'
        ]
    ];

    public function getValidationRules($method) {
        return array_get($this->validationRules, 'getaddressbalance');
    }

    public function getaddressbalance($params) {
        return [
            "confirmed" =>   getenv('ELECTRUM_ADDRESS_BALANCE_CONFIRMED'),
            "unconfirmed" => getenv('ELECTRUM_ADDRESS_BALANCE_UNCONFIRMED')
        ];
    }

    public function addrequest($params) {

    }

    public function listaddresses() {
//        $toReturn = [];
//        for($i = 0; $i < 25; $i++) {
//            $toReturn[] = str_random(34);
//        }
//        return $toReturn;
        return [
            "mBLEighX9BVFFTigu66DlLJVqjcYxx7w91",
            "zWEVb5yBHgUnpZTkiF5Q1VlthEpcFegEJi",
            "MN00EVrb3TH4dDfEmvsasE1rUhmsyi7XjX",
            "LFh5lJfNkjh0uPz12tpbSCJJcNZhJ3mTb2",
            "UAXcOAH1RH17s4ZR3ZwgB14OGwThNNZkX6",
            "vY8HFk0mr53kqoMfQBFLSKEIEceK5rWIaa",
            "j36IKhef0LF1fygHTReKeWbFT0FMUEbqZo",
            "EAbrjJrVxoaApUjnGVdyNoatXnaEiEL9Ld",
            "klNb1hqk4ktAIencTSA7ySBV13TqLToNwa",
            "LpIJ9HKggtGjTPGAI2lkbIor7YVB8fx1OK",
            "LiUxpZLIEqRfTrnJSgHPcCa2kkAIBFwbOC",
            "121Yr7RvqottCFER1jtPr8WV111XZcxBIT",
            "oWgURzeAnSV92VWQTXwp2c59yLdsDcqI4N",
            "En4hhrNC1cyLZjHHLhmJkqUKj3SOdCmeSh",
            "n0QRzNMnUzonyBKlzpufyXROvtagqkLEFE",
            "BIV0LcAmY4UmCtFwPsfPrupznThpdJTUmF",
            "LSlnYyPDwx1dQ0FLUivfm3FZVj7VGjXVRG",
            "jhb1mfBC2yNdqstLQF1mdJBnjbQfeDywt0",
            "QJc3jokKwEqdW3E5qUldRpZcLBlkFqgxQc",
            "qt8smUbreTzuqsdeqm9a5ooZh7sAZ7xdGP",
            "XjXVHzV8ZOeduKYq8UAMaVYxgFE1XCX2Pu",
            "G3xXmoC9QynaRGpfkCesUJIqQWjyMAKEtM",
            "xYHA4a2uQTXnMiNT8NUWEE9vr1sC0kdN0m",
            "1v3XOqxDmHn9hXsS9xOXlvw9Cv9kluull7",
            "LFORAGOfsrtWPMZQhvpA0RPExNYMD1YxUt"
        ];
    }
}