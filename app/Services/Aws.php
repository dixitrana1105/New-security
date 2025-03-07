<?php

namespace App\Services;

use Aws\Credentials\Credentials;
use Aws\Rekognition\RekognitionClient;

class Aws
{
    private $collectionId;

    public function __construct()
    {
        $this->collectionId = 'your-story-person';
    }

    public function setCollectionId($collectionId)
    {
        // dd($collectionId);
        $this->collectionId = $collectionId;
    }

    public function getCredentials()
    {
        return new Credentials(env('AWS_REKOGNITION_ACCESS_KEY'), env('AWS_REKOGNITION_SECRET_KEY'));
    }

    public function getRekognition()
    {
        return new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'credentials' => $this->getCredentials(),
        ]);
    }

   public function getSearchFacesByImage($bytes)
    {
        try {
            $this->checkCollecttionId();
        } catch (\Aws\Exception\AwsException $e) {
            if ($e->getAwsErrorCode() === 'ResourceNotFoundException') {
                $this->createCollection();
            } else {
                throw $e;
            }
        }

        return $this->getRekognition()->searchFacesByImage([
            'Image' => ['Bytes' => $bytes],
            'CollectionId' => $this->collectionId,
            'MaxFaces' => 5,
            'FaceMatchThreshold' => 90,
        ]);
    }

    public function checkCollecttionId()
    {
        return $this->getRekognition()->describeCollection([
            'CollectionId' => $this->collectionId,
        ]);
    }

    public function getIndexFaces($bytes)
    {
        return $this->getRekognition()->indexFaces([
            'Image' => ['Bytes' => $bytes],
            'CollectionId' => $this->collectionId,
            'DetectionAttributes' => ['DEFAULT'],
        ]);
    }

    public function createCollection()
    {
        return $this->getRekognition()->createCollection([
            'CollectionId' => $this->collectionId,
        ]);
    }

    public function deleteCollection()
    {
        $this->getRekognition()->deleteCollection([
            'CollectionId' => $this->collectionId,
        ]);
        $this->createCollection();
    }
}
