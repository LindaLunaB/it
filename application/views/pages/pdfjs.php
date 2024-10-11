<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        window.onload = function() {
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        }
    </script>
</head>
<body>
    <iframe width="100%" height="1150" src="<?= $data['url'] ?>" frameborder="0"></iframe>
    <div style="width: 100%; height: 1150px; position: absolute; top: 0; left: 0; z-index: 100;">
</body>
</html>