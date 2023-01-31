<!DOCTYPE html>
<html lang="en" class="light">
    <head>
    <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Pantalla 2</title>
        <link rel="stylesheet" href="dist/css/app.css" />
    </head>
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <div class="flex overflow-hidden">
            
            @include('menu') 
            
            <div class="content">
                <div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
                    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pantalla 2</li>
                        </ol>
                    </nav>
                  
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <img alt="Tinker Tailwind HTML Admin Template" src="{{ Session::get('data.identity.avatar'); }}">
                        </div>
                    </div>
                </div>
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Ruta Andres Postulante 1
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    @foreach ($rutas as $ruta)
                        @foreach ($ruta['dias'] as $dia => $value)
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <div class="ml-auto">
                                                @if ($value)
                                                <div class="report-box__indicator bg-success cursor-pointer">ACTIVO</div>
                                                @else
                                                <div class="report-box__indicator bg-danger cursor-pointer">INACTIVO</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $dia }}</div>
                                        <div class="text-base text-slate-500 mt-1">Tipo {{ $ruta['tipo'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </body>
</html>