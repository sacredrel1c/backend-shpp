<?php
return [
    '' => [
        'controller' => 'library',
        'action' => 'showCollection'
    ],
    '{offset:\?offset=\d+}' => [
        'controller' => 'library',
        'action' => 'showCollection'
    ],
    'index.php' => [
        'controller' => 'library',
        'action' => 'showCollection'
    ],

    'book/{id:\d+}'=>[
        'controller'=>'library',
        'action'=>'showBook'
    ],
    'admin/{offset:\?offset=\d+}' => [
        'controller' => 'admin',
        'action' => 'showAdminPage'
    ],
    'admin' => [
        'controller' => 'admin',
        'action' => 'showAdminPage'
    ],
    'admin/\?del={id:\d+}' => [
        'controller' => 'admin',
        'action' => 'showAdminPage'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/addAdmin' => [
        'controller' => 'admin',
        'action' => 'addAdmin'
    ],
    'admin/addAuthor' => [
        'controller' => 'admin',
        'action' => 'addAuthor'
    ],
    'admin/addBook' => [
        'controller' => 'admin',
        'action' => 'addBook'
    ],
    'admin/authors' => [
        'controller' => 'admin',
        'action' => 'showAuthors'
    ],
    '\?q={query:.*?}' => [
        'controller' => 'library',
        'action' => 'search'
    ],
    '\?click={click:\d+}' => [
        'controller' => 'library',
        'action' => 'click'
    ],
    'admin/authors{offset:\?offset=\d+}' => [
        'controller' => 'admin',
        'action' => 'showAuthors'
    ]
];
