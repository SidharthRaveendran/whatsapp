<?php

namespace NotificationChannels\WhatsApp;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use NotificationChannels\WhatsApp\Exceptions\CouldNotSendNotification;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WhatsApp.
 */
class WhatsApp
{
    /** @var HttpClient HTTP Client */
    protected $http;

    /** @var null|string Page Token. */
    protected $token;

    /** @var null|string Sender Phone */
    protected $phone;

    /** @var string Default Graph API Version */
    protected $graphApiVersion = '13.0';

    public function __construct(string $token = null, HttpClient $httpClient = null)
    {
        $this->token = $token;

        $this->http = $httpClient;
    }

    /**
     * Set Default Graph API Version.
     *
     * @param $graphApiVersion
     *
     * @return WhatsApp
     */
    public function setGraphApiVersion($graphApiVersion): self
    {
        $this->graphApiVersion = $graphApiVersion;

        return $this;
    }

    /**
     * Set phone number of sender account.
     *
     * @param string $phone
     *
     * @return WhatsApp
     */
    public function setSenderNumber($phone = null): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Send text message.
     *
     * @throws GuzzleException
     * @throws CouldNotSendNotification
     */
    public function send(array $params): ResponseInterface
    {
        return $this->post("{$this->phone}/messages", $params);
    }

    /**
     * @throws GuzzleException
     * @throws CouldNotSendNotification
     */
    public function get(string $endpoint, array $params = []): ResponseInterface
    {
        return $this->api($endpoint, ['query' => $params]);
    }

    /**
     * @throws GuzzleException
     * @throws CouldNotSendNotification
     */
    public function post(string $endpoint, array $params = []): ResponseInterface
    {
        return $this->api($endpoint, [
            'json' => $params,
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                "Content-Type" => 'application/json'
            ]
        ], 'POST');
    }

    /**
     * Get HttpClient.
     */
    protected function httpClient(): HttpClient
    {
        return $this->http ?? new HttpClient();
    }

    /**
     * Send an API request and return response.
     *
     * @param string $method
     *
     * @throws GuzzleException
     * @throws CouldNotSendNotification
     *
     * @return mixed|ResponseInterface
     */
    protected function api(string $endpoint, array $options, $method = 'GET')
    {
        if (empty($this->token)) {
            throw CouldNotSendNotification::facebookPageTokenNotProvided('You must provide your WhatsApp Business Account\'s System User access token to make any API requests.');
        }

        $url = "https://graph.facebook.com/v{$this->graphApiVersion}/{$endpoint}";

        try {
            return $this->httpClient()->request($method, $url, $options);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::facebookRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithFacebook($exception);
        }
    }
}
