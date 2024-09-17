<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>
    <script>
        function updateCounter() {
            fetch('counter.php')
                .then(response => response.text())
                .then(data => {
                     
                       document.getElementById('counterDiv').innerText = data;
                });
        }

        setInterval(updateCounter, 1000); // Update every second
    </script>
</head>
<body>
    <div id="counterDiv"></div>
</body>
</html>