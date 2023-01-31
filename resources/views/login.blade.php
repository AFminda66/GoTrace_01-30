<!DOCTYPE html>

<html lang="en" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="dist/css/app.css" />
    </head>
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        
                        <span class="text-white text-lg ml-3"> Ingreso </span> 
                    </a>
                    <div class="my-auto">
                        
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Inicia tu sesion para comenzar
                            <br>
                            para comenzar.
                        </div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form method="POST" action="/login_chek">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Iniciar sesion
                        </h2>
                        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">Inicia tu sesion para comenzar</div>
                        <div class="intro-x mt-8">
                            <input type="email" class="intro-x login__input form-control py-3 px-4 block" placeholder="Correo" name="email" required >
                            <input type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" name="Contraseña" placeholder="Password">
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Ingresar</button>
                        </div>
                        <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">Realizado <a class="text-primary dark:text-slate-200" href="">Andres Viveros</a></a> </div>
                    
                    </form>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::get('message'))
        <script>
            alert("{{ Session::get('message'); }}")
        </script>
        @endif
    </body>
</html>