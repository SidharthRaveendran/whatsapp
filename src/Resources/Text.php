<?php

namespace NotificationChannels\WhatsApp\Resources;

class Text implements Resource
{
    /**
     * @var boolean
     */
    protected $previewUrl = false;

    /**
     * @var string|null
     */
    protected $body = '';

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self;
    }
    
    /**
     * @param string|null $previewUrl
     * @return Text
     */
    public function getPreviewUrl()
    {
        return $this->previewUrl;
    }

    /**
     * @return bool
     */
    public function setPreviewUrl(?bool $previewUrl): self
    {
        $this->previewUrl = $previewUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return body
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'preview_url' => $this->getPreviewUrl(),
            'body' => $this->getBody(),
        ];
    }
}
