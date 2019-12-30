<?php
$databaseInfo = [
    [
        'db_host'   => 'localhost',
        'db_name'   => 'webquanlybanhang',
        'db_user'   => 'root',
        'db_passwd' => ''
    ]
];

print_r("<pre>");
print_r($databaseInfo);
foreach ($databaseInfo as $value) {
    # code...
    echo $value['db_host'] = 'database private';
    echo "\n";
    echo $value['db_name'] = 'new name';
    echo "\n";
    echo $value['db_user'] = 'root';
    echo "\n";
    echo $value['db_passwd'] = 'toor';
    echo "\n";
}
