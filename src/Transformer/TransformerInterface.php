<?php
namespace Ibrows\RestBundle\Transformer;

use Ibrows\RestBundle\Model\ApiListableInterface;

interface TransformerInterface
{
    /**
     * Get proxy to resource if possible.
     * Else give the same as getResource.
     *
     * @param string $path
     * @return ApiListableInterface|null
     */
    public function getResourceProxy($path);

    /**
     * @param string $path
     * @return ApiListableInterface|null
     */
    public function getResource($path);

    /**
     * @param ApiListableInterface $object
     * @return array<string, mixed>|null
     */
    public function getResourceConfig(ApiListableInterface $object);

    /**
     * @param ApiListableInterface $object
     * @return string|null
     */
    public function getResourcePath(ApiListableInterface $object);
}