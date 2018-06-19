<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAKgHMDTM:APA91bEIZ8-X9xLEf3dw70bDCQFTzUlBgkjl9NJVrKh3P9T7QScc-5izLxi1KhAfpMKYCygi9M0akVnRaLmCmMoz9eQTLbGWgSMxoPevffcshXCpoFk1hsjHys0rKd4vdys4UAL4YawJ',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/PushCertificateAndKey.pem',
      'passPhrase' => 'YachtsAndBoats', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => false
  ]
];
