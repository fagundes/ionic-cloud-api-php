<?php
namespace Ionic\Service;

use Ionic\Client;
use Ionic\Service;

class Push extends Service
{

    /**
     * @var Push\Resource\Notifications
     */
    public $notifications;

    /**
     * @var Push\Resource\Messages
     */
    public $messages;

    /**
     * @var Push\Resource\DeviceTokens
     */
    public $deviceTokens;

    /**
     * Constructs the internal representation of the Books service.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->rootUrl     = Client::API_BASE_PATH;
        $this->servicePath = 'push';
        $this->version     = 'v2';
        $this->serviceName = 'Push';

        $this->deviceTokens = new Push\Resource\DeviceTokens(
            $this,
            $this->serviceName,
            'tokens',
            [
                'methods' => [
                    'associateUser'       => [
                        'path'       => '/tokens/{token_id}/users/{user_id}',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'user_id'  => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                            'token_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'create'              => [
                        'path'       => '/tokens',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'delete'              => [
                        'path'       => '/tokens/{token_id}',
                        'httpMethod' => 'DELETE',
                        'parameters' => [
                            'token_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'dissociateUser'      => [
                        'path'       => '/tokens/{token_id}/users/{user_id}',
                        'httpMethod' => 'DELETE',
                        'parameters' => [
                            'user_id'  => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                            'token_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'                 => [
                        'path'       => '/tokens/{token_id}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'token_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'listAssociatedUsers' => [
                        'path'       => '/tokens/{token_id}/users',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'token_id'  => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                            'page'      => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                            'page_size' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'list'                => [
                        'path'       => '/tokens',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'user_id'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'show_invalid' => [
                                'location' => 'query',
                                'type'     => 'boolean',
                            ],
                            'page'         => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                            'page_size'    => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'update'              => [
                        'path'       => '/tokens/{token_id}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'token_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->messages = new Push\Resource\Messages(
            $this,
            $this->serviceName,
            'messages',
            [
                'methods' => [
                    'delete' => [
                        'path'       => '/messages/{message_id}',
                        'httpMethod' => 'DELETE',
                        'parameters' => [
                            'message_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'    => [
                        'path'       => '/messages/{message_id}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'message_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ]
            ]
        );

        $this->notifications = new Push\Resource\Notifications(
            $this,
            $this->serviceName,
            'notifications',
            [
                'methods' => [
                    'create'       => [
                        'path'       => '/notifications',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'delete'       => [
                        'path'       => '/notifications/{notification_id}',
                        'httpMethod' => 'DELETE',
                        'parameters' => [
                            'notification_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'          => [
                        'path'       => '/notifications/{notification_id}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'notification_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                            'fields'          => [
                                'location' => 'query',
                                'type'     => 'array',
                            ],
                        ],
                    ],
                    'list'         => [
                        'path'       => '/notifications',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'fields'    => [
                                'location' => 'query',
                                'type'     => 'array',
                            ],
                            'page'      => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                            'page_size' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'replace'      => [
                        'path'       => '/notifications/{notification_id}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'notification_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'listMessages' => [
                        'path'       => '/notifications/{notification_id}/messages',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'notification_id' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                            'page'            => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                            'page_size'       => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                ]
            ]
        );
    }

}