<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Personio Hierarchy</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .error, .heirarchy {
                display: none;
            }
        </style>

        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous">
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="hierarchy">

            </div>
            <div class="content">
                <div class="title m-b-md">
                    Upload Hierarchy
                </div>
                <div class="error"></div>
                <div>
                    <form id="upload" enctype="multipart/form-data">
                        <p>Input Text:</p>
                        <textarea id="json" name="json"></textarea>
                        <p>or</p>
                        <p>Select file to upload:</p>
                        <input type="file" name="hierarchy" id="hierarchy"><br>
                        <input type="submit" value="Upload File" name="submit">
                    </form>
                </div>
            </div>
        </div>
        <script src="/js/upload.js"></script>
    </body>
</html>
