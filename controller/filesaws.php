<?php

require '../vendor/autoload.php';

use Aws\S3\S3CLIENT;
use Aws\S3\Exception\S3Exception;


$GLOBALS['s3'] = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => [
        'key' => 'ASIA6HATAWKW2GVDFZOB',
        'secret' => 'jShbAi3L4jW+XZclwNfQB9XYSgM3YJXAI0MRu9fF',
        'token' => 'FwoGZXIvYXdzEFsaDNRGc0I59vimRe9ZTiLJAQg4X0YmuvQMaOxEHXFWTy4EOJDIlByhpwLoEXvkS6sdMFm+Mev0k+j93qGVP6t0utBe9Dptwy5mz/DCCL/pXhoyOUI6qrMnTrGRwFRtfxbg6MFNp7Fr/0Q8nDQoWoAVadaeWrjqEQun2Mjh63j+7RvmcE0NVcRn9AZxTCvlsGf31YqgG5NnTwLC1QESsOI3zZ6XbJNsW+tXqVoR0zk2QTFLOdoQbyKIyrL+dIKi0LNbVox9ygJLaKjmbMa3JXESjfWARaiGcdR9Uii2qMGABjItiYI8aekujA29T3cIeHWXAMJx7oAmbrj9A8E/8p9l1OY/mQYxcNVPcMm82Iys'
    ],
]);

$GLOBALS['bucket'] = 'rohitsbucket2';

function imgAlS3()
{
    try {
        $result = $GLOBALS['s3']->putObject([
            'Bucket' => $GLOBALS['bucket'],
            'Key' => $_SESSION['uploadFile']['name'],
            'Body' => 'Nice this does work!!!!!!!!!!!!!!!! owo',
            'ContentType' => $_SESSION['uploadFile']['type'],
            'ACL' => 'public-read',
            'StorageClass' => 'REDUCED_REDUNDANCY',
            'SourceFile' => $_SESSION['uploadFile']['tmp_name']
        ]);
        $arrayReturn = [];

        array_push($arrayReturn, $_SESSION['uploadFile']['name']);
        array_push($arrayReturn, $result['ObjectURL'] . PHP_EOL);

        return $arrayReturn;
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}

function borrarImg($key)
{
    try {
        $result = $GLOBALS['s3']->deleteObject([

            'Bucket' => $GLOBALS['bucket'],
            'Key' => $key
        ]);
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}

?>