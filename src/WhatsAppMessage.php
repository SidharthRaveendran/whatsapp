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
     * @var Notification|null
     */
    protected $template;

    /**
     * @var string|null
     */
    protected $to;

    /**
     * @var array|null
     */
    protected $data;

    public static function create(): self
    {
        return new self;
    }

    /**
     * @return string|null
     */
    public function getMessagingProduct(): ?string
    {
        return $this->messaging_product;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return FcmMessage
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
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
        return [
            'messaging_product' => $this->getName(),
            'to' => $this->getTo(),
            'type' => $this->getType(),
            'template' => !is_null($this->getTemplate()) ? $this->getTemplate()->toArray() : null,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
