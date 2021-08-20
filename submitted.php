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
            <p style="left:50%; text-align: center;color:dodgerblue; font-size: 48px;">You are successfully registered</p>
        </div>
        <div class="c-display-bottommiddle c-container c-large">
            <button class="button2" style="border-radius: 10px; margin-bottom: 9em; font-size: 32px;" onclick="window.open('<?php echo $telegram_url; ?>', '_blank' )"><i class="telegram-icon">D</i> |                   Join our
                telegram channel</button>
        </div>
    </div>
</body>

</html>