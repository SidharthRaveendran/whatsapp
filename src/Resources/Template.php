<?php

namespace App\NotificationChannels\Whatsapp\Resources;

class Template implements Resource
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var array|null
     */
    protected $language;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $title
     * @return Template
     */
    public function setName(?string $title): self
    {
        $this->title = $title;

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
     * @return Notification
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getLanguage(): ?array
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return Template
     */
    public function setLanguage(?array $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'language' => $this->getLanguage(),
        ];
    }
}
