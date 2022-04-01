<?php

namespace App\Model;

class Article
{
    protected int $id_article;
    protected string $title;
    protected string $content;
    protected string $created_at;

    public function toArray(): array
    {
        return [
            "id_article" => $this->id_article,
            "title" => $this->title,
            "content" => $this->content,
            "created_at" => $this->created_at
        ];
    }

    public static function fromArray(array $article): Article
    {
        $a = new Article();
        return $a->setTitle($article['title'])
            ->setContent($article['content']);
    }

    /**
     * @return int
     */
    public function getIdArticle(): int
    {
        return $this->id_article;
    }

    /**
     * @param int $id_article
     */
    public function setIdArticle(int $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
