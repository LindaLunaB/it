<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
</head>
<body>
    <div style="display: flex; justify-content: center;">
        <canvas id="the-canvas"></canvas>
    </div>
    <script type="module">
        //var url = 'http://192.168.1.176/it/index/viewFile?file=15/Apendices/05/1996/000000068/01/15_05_1996_000000068_01_0001.pdf';
        //var url = 'http://192.168.1.176/it/public/tes.pdf';
        var url = "<?= $data['url'] ?>";
        var { pdfjsLib } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

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
                console.log('Page rendered');
            });
            });
        }, function (reason) {
            console.error(reason);
        });
    </script>
    <script>
        const canvas = document.getElementById('the-canvas');
        canvas.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>
</body>
</html>