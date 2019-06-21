<?php
require_once 'vendor/autoload.php';
require_once "./random_string.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

define("ACCOUNT_NAME", "storageabdhi");
define("ACCOUNT_KEY", "x3vziq/bHong8qCwo0xSPjZ8jVHDCHyHraaz5w0/n5wdWuN/7t1D1qnkRBv189OqgzKtEgMez1ONy/74jrOP+g==");

class BlobRepository
{
    public $connectionString = "DefaultEndpointsProtocol=https;AccountName=".ACCOUNT_NAME.";AccountKey=".ACCOUNT_KEY;
    private $blobClient;
    private $createContainerOptions;
    private $containerName;


    /**
     * BlobRepository constructor.
     * @param $blobClient
     */
    public function __construct()
    {
        $this->blobClient = BlobRestProxy::createBlobService($this->connectionString);
    }

    public function createContainerOption(){
        $this->createContainerOptions = new CreateContainerOptions();
        $this->createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
        $this->createContainerOptions->addMetaData("key1", "value1");
        $this->createContainerOptions->addMetaData("key2", "value2");

//        $this->containerName = "blockblobs".generateRandomString();
        $this->containerName = "test1";
    }

    public function setContainerName(){
        $this->containerName = "test1";
    }

    public function uploadToAzure($filename, $filecontent){
//        $this->createContainerOption();

        $this->setContainerName();

//        $this->blobClient->createContainer($this->containerName, $this->createContainerOptions);
        $this->blobClient->createBlockBlob($this->containerName, $filename, $filecontent);

//        echo("INFO: Upload Completed");
    }

    public function getAzureList(){
        $this->setContainerName();
//        $result = $this->blobClient->listBlobs($this->containerName);
        return $this->blobClient->listBlobs($this->containerName);
    }

}