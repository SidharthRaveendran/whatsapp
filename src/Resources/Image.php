<?php

namespace NotificationChannels\WhatsApp\Resources;

class Image implements Resource
{
    /**
     * @var int
     */
    protected $id ;


    /**
     * @return static
     */
    public static function create(): self
    {
        return new self;
    }
    
    /**
     * @param string|null $previewUrl
     * @return Image
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
