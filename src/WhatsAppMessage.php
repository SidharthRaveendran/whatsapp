<?php

namespace NotificationChannels\WhatsApp;

use Illuminate\Support\Arr;
use NotificationChannels\WhatsApp\Resources\Template;
use NotificationChannels\WhatsApp\Resources\Text;
use NotificationChannels\WhatsApp\Resources\Image;


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
     * @var Text|array
     */
    protected $text =[];

     /**
     * @var Image|array
     */
    protected $image =[];

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
     * @param Text $text
     * @return Text
     */
    public function setText(?Text $text)
    {
        $this->text = $text;
        
        return $this;
    }

    /**
     * @return Text|null
     */
    public function getText(): ?Text
    {
        return  $this->text;
    }

    /**
     * @param Image $text
     * @return Image
     */
    public function setImage(?Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return text|null
     */
    public function getImage(): ?Image
    {
        return  $this->image;
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
            'link' => 'https://google.com',
        ];

        switch ($this->getType()) {
            case "template": 
                $array['template'] = !is_null($this->getTemplate()) ? $this->getTemplate()->toArray() : null;
                break;
            case "text": 
                $array['text'] = !is_null($this->getText()) ? $this->getText()->toArray() : null;
                break;
            case "image": 
                $array['image'] = !is_null($this->getImage()) ? $this->getImage()->toArray() : null;
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
