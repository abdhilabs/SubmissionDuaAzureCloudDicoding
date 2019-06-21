<?php
    require_once ('BlobRepository.php');

    $azzure_upload = new BlobRepository();

    if(isset($_POST['submit'])):
        $file_name = $_FILES['fileToUpload']['name'];
        $file = file_get_contents($_FILES['fileToUpload']['tmp_name']);
        $azzure_upload->uploadToAzure($file_name, $file);
//        echo("<h1>".$file_name."</h1>");
    endif;

    $file_list = $azzure_upload->getAzureList();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Azure Submission 2 - Abdhilabs</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>
    <body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Submission 2</a>                
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Azure Blob Storage</a></li>
                <li><a href="CognitiveService.php">Azure Cognitive Service</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Upload to Azure Blob Storage</div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="uploadtostorage">Upload Your Files here</label>
                            <input type="file" class="form-control-file" id="uploadtostorage" name="fileToUpload">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <table class="table table-bordered">
                <thead>
                <th>File Name</th>
                <th>Download File</th>
                </thead>
                <tbody>
                <?php foreach ($file_list->getBlobs() as $blob): ?>
                    <tr>
                        <td><?= $blob->getName() ?></td>
                        <td><a href="<?= $blob->getUrl() ?>">View File</a> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>