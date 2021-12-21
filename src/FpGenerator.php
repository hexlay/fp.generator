<?php

namespace Hexlay\FpGenerator;

use LengthException;
use OutOfRangeException;
use function array_rand;
use function implode;
use function in_array;
use function range;
use function str_split;

class FpGenerator
{

    public function generate(int $length = 6, int $strength = 3): string
    {
        if ($length < 6) {
            throw new LengthException('Password length should be at least 6');
        }

        if (!in_array($strength, [1, 2, 3])) {
            throw new OutOfRangeException('Password strength should be between 1-3');
        }

        $allowed = $this->allowlist()[$strength];
        $init = $this->init($allowed);
        $password = $init['password'];
        $characters = str_split($init['characters']);
        for ($i = 0; $i < $length - $this->countAllowed($allowed); $i++) {
            $password .= $characters[array_rand($characters)];
        }
        return $password;
    }

    private function init(array $allowed): array
    {
        $password = '';
        $characters = '';
        foreach ($allowed as $value) {
            $count = $value['count'];
            $data = $value['data'];
            for ($i = 0; $i < $count; $i++) {
                $password .= $data[array_rand($data)];
            }
            $characters .= implode('', $data);
        }
        return [
            'password' => $password,
            'characters' => $characters
        ];
    }

    private function countAllowed(array $allowed): int
    {
        $result = 0;
        foreach ($allowed as $data) {
            $result += $data['count'];
        }
        return $result;
    }

    private function allowlist(): array
    {
        return [
            1 => [
                [
                    'count' => 2,
                    'data' => range('A', 'Z')
                ],
                [
                    'count' => 1,
                    'data' => range('a', 'z')
                ],
            ],
            2 => [
                [
                    'count' => 2,
                    'data' => range('A', 'Z')
                ],
                [
                    'count' => 1,
                    'data' => range('a', 'z')
                ],
                [
                    'count' => 1,
                    'data' => range(2, 5)
                ],
            ],
            3 => [
                [
                    'count' => 1,
                    'data' => range('A', 'Z')
                ],
                [
                    'count' => 1,
                    'data' => range('a', 'z')
                ],
                [
                    'count' => 1,
                    'data' => range(2, 5)
                ],
                [
                    'count' => 1,
                    'data' => str_split('!#$%&(){}[]=')
                ],
            ]
        ];
    }

}
