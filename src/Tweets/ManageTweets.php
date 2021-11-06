<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Request;

/**
 * Posting and deleting tweets
 */
class ManageTweets extends ApiBase
{
    /**
     * Twitter Credentials
     *
     * @var array
     */
    protected array $credentials;

    /**
     * Base endpoint
     *
     * @var string
     */
    protected string $endpoint = 'tweets';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Send a tweet
     *
     * @param object $tweet
     * @return object|exception
     */
    public function send($tweet)
    {
        $tweet = $tweet->build();
        return $this->post($this->credentials, $this->endpoint, null, $tweet, false, true);
    }

    /**
     * Delete tweet
     *
     * @param string $tweet_id
     * @return object|exception
     */
    public function unsend($tweet_id)
    {
        $path = $this->endpoint . '/' . $tweet_id;
        return $this->delete($this->credentials, $path, null, null, false, true);
    }

    /**
     * Basic media upload via the API v1.1 because
     * media upload not yet available on v2
     *
     * @param string $file
     * @return object|exception
     */
    public function mediaUpload($file)
    {
        $request = new Request($this->credentials);
        return $request->uploadMedia($file);
    }
}