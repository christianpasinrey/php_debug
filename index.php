<?

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEBUG</title>
</head>

<body>
    <pre>
        <?php
        require_once('User.php');
        include('debug.php');

        //session_start();
        //dd($_POST, $_SESSION, $_GET, $_FILES, $_COOKIE, $_SERVER);

        try {
            $data = [
                'name' => 'John Doe',
                'email' => 'johndoe@example.net',
                'age' => 30,
                //'isStudent' => false,
                'address' => [
                    'street' => '123 Main St',
                    'city' => 'Springfield',
                    'state' => 'IL',
                    'zip' => '62701'
                ],
                'hobbies' => ['reading', 'swimming', 'coding'],
            ];
            $user = new User($data);
            //$error = createUser('John Doe', 30);
            //dd($user->__toString());
            dd($user);
        } catch (Exception $e) {
            $data = [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ];
            // Capturamos Exception para atrapar excepciones definidas
            dd($data);
        } catch (Error $e) {
            $data = [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ];
            // Capturamos Error en lugar de Exception para atrapar errores de función indefinida
            dd($data);
        }
        ?>
    </pre>
</body>

</html>