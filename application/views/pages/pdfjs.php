<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
    <!-- <script src="<?= base_url ?>public/libraries/pdf.mjs" type="module"></script> -->
</head>
<body>
    <div style="display: flex; justify-content: center;">
        <div>
            <p id="loading" style="font-size: 50px; text-align: center;">Cargando archivo....</p>
            <canvas id="the-canvas"></canvas>
        </div>
    </div>
    <script type="module">
        var url = "<?= $data['url'] ?>";
        var { pdfjsLib } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';
        //pdfjsLib.GlobalWorkerOptions.workerSrc = '<?= base_url ?>public/libraries/pdf.worker.mjs';

        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            var pageNumber = 1;
            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({scale: scale});

                var canvas = document.getElementById('the-canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    document.querySelector('#loading').setAttribute('style', 'display: none');
                    console.log('Page rendered');
                });
            });
        }, function (reason) {
            console.error(reason);
        });
    </script>
    <script>
        window.onload = function() {
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        }
    </script>
</body>
</html>