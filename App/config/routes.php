<?php

return [

	'chat' => [
		'controller' => 'main',
		'action' => 'index',
	],
    'chat/home' => [
        'controller' => 'main',
        'action' => 'index',
    ],

	'chat/login' => [
		'controller' => 'account',
		'action' => 'login',
	],

    'chat/postlogin' => [
        'controller' => 'account',
        'action' => 'postLogin',
    ],

    'chat/postregister' => [
        'controller' => 'account',
        'action' => 'postRegister',
    ],

    'chat/postmessage' => [
        'controller' => 'account',
        'action' => 'postMessage',
    ],
    'chat/postpersmessage' => [
        'controller' => 'account',
        'action' => 'postPersMessage',
    ],

	'chat/register' => [
		'controller' => 'account',
		'action' => 'register',
	],

    'chat/postlogout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

];