<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Lazy Load</title>
        <style type="text/css">
            img {
                width:800px;
                height:800px;
            }

            img:not([src]) {
                visibility: hidden;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">
            <img data-src="images/1.jpg"><br>
            <img data-src="images/2.jpg"><br>
            <img data-src="images/3.jpg"><br>
            <img data-src="images/4.jpg"><br>
            <img data-src="images/5.jpg"><br>
            <img data-src="images/6.jpg"><br>
            <img data-src="images/7.png"><br>
            <img data-src="images/8.jpg"><br>
            <img data-src="images/9.jpg"><br>
            <img data-src="images/10.jpg"><br>
            <img data-src="images/11.jpg"><br>
            <img data-src="images/12.jpg"><br>
            <img data-src="images/13.png"><br>
            <img data-src="images/14.jpg">
        </div>
        <script>
            var images = document.querySelectorAll('img');

            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        var img = entry.target;
                        img.setAttribute('src', img.getAttribute('data-src'));
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                // root: document.querySelector('#scroll'),
                rootMargin: '0px 0px -10% 0px',
                threshold: 0
            });

            images.forEach(img => {
                observer.observe(img);
            });
        </script>
    </body>
</html>