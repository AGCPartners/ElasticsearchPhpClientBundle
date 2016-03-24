<?php

namespace Ulff\ElasticsearchPhpClientBundle\Model;

use Ulff\ElasticsearchPhpClientBundle\Exception\MaxAllowedSearchResultsSizeExceededException;

class SearchParams
{
    const DEFAULT_SIZE = 10;
    const MAX_ALLOWED_SIZE = 10000;

    /**
     * @var string
     */
    private $index;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $body;

    /**
     * @var int
     */
    private $size;

    /**
     * @param string $index
     * @param string $type
     */
    public function __construct($index, $type)
    {
        $this->index = $index;
        $this->type = $type;
        $this->size = self::DEFAULT_SIZE;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'index' => $this->getIndex(),
            'type' => $this->getType(),
            'body' => $this->getBody(),
            'size' => $this->getSize()
        ];
    }

    /**
     * @param array $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        if ($size > self::MAX_ALLOWED_SIZE) {
            throw new MaxAllowedSearchResultsSizeExceededException($size);
        }
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
