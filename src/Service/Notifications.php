<?php
namespace Ionic\Service;

use Ionic\Client;
use Ionic\Service;
use Ionic\Service\Notifications\Resource\Notifications as NotificationsResource;

class Notifications extends Service
{

    /**
     * @var Notifications\Resource\Notifications
     */
    public $notifications;

    /**
     * @var Notifications\Resource\Messages
     */
    public $messages;

    /**
     * Constructs the internal representation of the Books service.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->rootUrl     = Client::API_BASE_PATH;
        $this->servicePath = 'push/notifications';
        $this->version     = 'v2';
        $this->serviceName = 'notifications';

        $this->notifications = new NotificationsResource(
            $this,
            $this->serviceName,
            'notifications',
            [
                'methods' => [
                    'get'  => [
                        'path'       => '/{notification_id}',
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
                    'list' => [
                        'path'       => '',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'fields'      => [
                                'location' => 'query',
                                'type'     => 'array',
                            ],
                            'page'        => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                            'page_number' => [
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