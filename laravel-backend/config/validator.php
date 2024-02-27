<?php

return [
  'transaction' => [
    'messages' => [
      'required' => 'The :attribute attribute is required',
      'in' => 'The recipient and transaction currency must match',
      'gte' => 'The transaction should be atleast 1 currency value',
      'numeric' => 'Invalid currency account id, must be a number',
      'not_in' => "Can't transfer funds to the same account",
    ]
  ]
];