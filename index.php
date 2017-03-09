<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">      
        <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>    
    <body>
        <header>Welcome in the chat!</header>
        
        <main>
            <ul class="content">
                
            </ul>
            <div clas="message">
                <form method="post">
                    <input type="text" name="nick" maxlength="16" placeholder="Nick" autocomplete="off" required>
                    <textarea type="text" name="message" rows="4" maxlength="140" placeholder="Message" required></textarea>
                    <input type="submit" value="Send">
                </form>
            </div> 
        </main>
        
        <script src="script.js"></script>
        <noscript>
            alert("Please enable JavaScript");
        </noscript>
    </body> 
</html>