<?php

return [
    'name' => trim(env('BANK_NAME'), '"'),
    'code' => trim(env('BANK_CODE'), '"'),
    'account_number' => trim(env('BANK_ACCOUNT_NUMBER'), '"'),
    'account_name' => trim(env('BANK_ACCOUNT_NAME'), '"'),
    'branch' => trim(env('BANK_BRANCH'), '"'),
];
