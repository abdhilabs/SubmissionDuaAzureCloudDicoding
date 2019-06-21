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
<script type="text/javascript">
    function processImage() {
        var subscriptionKey = "2755f3ba2d8b40e8a35dcdcdc50a9268";

        var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";

        var params = {
            "visualFeatures": "Categories,Description",
            "details": "",
            "language": "en",
        };

        var sourceImageUrl = document.getElementById("textImageUrl").value;
        document.querySelector("#sourceImage").src = sourceImageUrl;

        $.ajax({
            url: uriBase + "?" + $.param(params),

            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader(
                    "Ocp-Apim-Subscription-Key", subscriptionKey);
            },

            type: "POST",

            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })

            .done(function(data) {
                // Show formatted JSON on webpage.
                // console.log(data.description.captions[0].text);
                // $("#responseTextArea").val(JSON.stringify(data, null, 2));
                $("#responseTextArea").val(data.description.captions[0].text);
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                // Display error message.
                var errorString = (errorThrown === "") ? "Error. " :
                    errorThrown + " (" + jqXHR.status + "): ";
                errorString += (jqXHR.responseText === "") ? "" :
                    jQuery.parseJSON(jqXHR.responseText).message;
                alert(errorString);
            });
    };
</script>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Submission 2</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Azure Blob Storage</a></li>
            <li class="active"><a href="#">Azure Cognitive Service</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Azure Cognitive Services</div>
            <div class="panel-body">
<!--                <form enctype="multipart/form-data" method="post">-->
                <div class="form-group">
                    <label for="textImageUrl">Paste Image URL Here</label>
                    <input type="text" class="form-control" id="textImageUrl" name="txtimageurl" placeholder="Image URL"
                           value="http://www.atmajaya.ac.id/imagecontent/fiabikom-fieldtrip-acicis-google-1.jpg">
                </div>
                <div class="form-group">
                    <button onclick="processImage()" class="btn btn-success">Analyze image</button>
                </div>
<!--                </form>-->
            </div>
        </div>
    </div>
    <div class="row col-md-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading">Image Analyze</div>
            <div class="panel-body">
                <div class="form-group">
                    <img id="sourceImage" class="col-md-12"/>
                </div>
                <div class="form-group">
<!--                    <label id="responseTextArea"  >Paste Image URL Here</label>-->
                    <label for="responseTextArea">Image Description</label>
                    <input type="text" id="responseTextArea" class="form-control rounded-0" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>