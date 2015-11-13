<?php

 return [
     'uthando_user' => [
         'acl' => [
             'roles' => [
                 'guest'			=> [
                     'privileges'	=> [
                         'allow' => [
                             'controllers' => [
                                 'UthandoNews\Controller\News' => ['action' => ['view', 'news-item']],
                             ],
                         ],
                     ],
                 ],
                 'admin'        => [
                     'privileges'    => [
                         'allow' => [
                             'controllers' => [
                                 'UthandoNews\Controller\News' => ['action' => 'all']],
                         ],
                     ],
                 ],
             ],
             'resources' => [
                 'UthandoNews\Controller\News',
             ],
         ],
     ],
 ];