<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework</title>
</head>
<body>
    <main>
        <?php
            if($header != NULL && file_exists(BASE_PATH . 'application/views/' . $header . '.php')){
                require_once BASE_PATH . 'application/views/' . $header . '.php';
            }
        ?>

        <?php
            if(file_exists(BASE_PATH . 'application/views/' . $vista . '.php')){
                require_once BASE_PATH . 'application/views/' . $vista . '.php';
            }
        ?>

        <?php
            if($footer != NULL && file_exists(BASE_PATH . 'application/views/' . $footer . '.php')){
                require_once BASE_PATH . 'application/views/' . $footer . '.php';
            }
        ?>
    </main>
    <?php
        if (isset($data['extra_js']))  echo $data['extra_js'];
    ?>
</body>
</html>