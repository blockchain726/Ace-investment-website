<!DOCTYPE html>
<html>
<?php include("config.php"); ?>
<head>
    <title>
        Ace Investments
    </title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="icon" type="image/png" href="media/favicon.png" />
</head>

<body>
    <div style="top:0; left:0; right:100%; height: 4em; background-color: dodgerblue;">
    </div>
    <div class="c-display-container">
        <div class="c-display-amiddle c-large">
            <p style="left:50%; text-align: center;color:dodgerblue; font-size: 48px;">One or more of the submitted data are invalid<br>Please try again</p>
        </div>
        <div class="c-display-bottommiddle c-container c-large">
            <button class="button2" style="border-radius: 10px; margin-bottom: 9em; font-size: 32px;" onclick="window.location = '<?php echo $base_url; ?>'">Retry</button>
        </div>
    </div>
</body>
</html>