<?php

namespace NotificationChannels\WhatsApp;

use Illuminate\Support\Arr;
use NotificationChannels\WhatsApp\Resources\Template;

class WhatsAppMessage
{
    /**
     * @var string|null
     */
    protected $messagingProduct = 'whatsapp';

    /**
     * @var string|null
     */
    protected $type = 'template';

    /**
     * @var string|null
     */
    protected $recipient_type = 'individual';

    /**
     * @var Template|null
     */
    protected $template;

    /**
     * @var Text|null
     */
    protected $text;

    /**
     * @var string|null
     */
    protected $to;

    /**
     * @var array|null
     */
    // protected $data;

    public static function create(): self
    {
        return new self;
    }

    /**
     * @return string|null
     */
    public function getMessagingProduct(): ?string
    {
        return $this->messagingProduct;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     * @return FcmMessage
     */
    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Template|null
     */
    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    /**
     * @param Template|null $template
     * @return FcmMessage
     */
    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Text|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return FcmMessage
     */
    public function setText(string $text, bool $preview = false): self
    {
        // TODO:
        // Check if text has https:// or http://
        // and preview url can be automatically true, 
        // Should also provide an override

        $this->text = [
            "preview_url" => $preview,
            "body" => $text
        ];

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param string|null $to
     * @return WhatsAppMessage
     */
    public function setTo(?string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return WhatsAppMessage
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function toArray()
    {
        $array = [
            'recipient_type' => $this->recipient_type,
            'messaging_product' => $this->getMessagingProduct(),
            'to' => $this->getTo(),
            'type' => $this->getType(),
        ];

        switch ($this->getType()) {
            case "template": 
                $array['template'] = !is_null($this->getTemplate()) ? $this->getTemplate()->toArray() : null;
                break;
            case "text": 
                $array['text'] = !is_null($this->getText()) ? $this->getText() : null;
                break;
            default: break;
        }

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
