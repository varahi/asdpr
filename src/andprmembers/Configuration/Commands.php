<?php

return [
    'andprmembers:sendemail' => [
        'class' => \T3Dev\Andprmembers\Command\SendEmailCommandController::class,
        'schedulable' => true
    ],
    'andprmembers:deleteUser' => [
        'class' => \T3Dev\Andprmembers\Command\DeleteUserCommandController::class,
        'schedulable' => true
    ],
];
