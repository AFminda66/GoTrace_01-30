<!DOCTYPE html>
<html lang="en" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Pantalla 1</title>
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
                            <li class="breadcrumb-item active" aria-current="page">Pantalla 1</li>
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
                        Datos de usuario
                    </h2>
                </div>
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="Tinker Tailwind HTML Admin Template" class="rounded-full" src="{{ Session::get('data.identity.avatar'); }}">
                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                    {{ Session::get('data.identity.name'); }}
                                    {{ Session::get('data.identity.surname'); }}
                                </div>
                                <div class="text-slate-500">{{ Session::get('data.identity.name'); }}</div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">Detalles de contacto</div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i>{{ Session::get('data.identity.email'); }}</div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                            <div class="text-center rounded-md w-20 py-3 mr-3">
                                <button class="btn btn-primary w-24 mr-1 mb-2 guardar">Guardar Usuario</button>
                            </div>
                            <div class="text-center rounded-md w-20 py-3 ml-2">
                            <a id="programmatically-show-slide-over" href="javascript:;" class="btn btn-primary mr-1 mb-2">Editar Usuario</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="programmatically-slide-over" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-5">
                        <h2 class="font-medium text-base mr-auto">
                            Puedes editar los siguientes campos
                        </h2>
                    </div>
                    <div class="modal-body p-10 ">
                        <div id="vertical-form" class="">
                            <form>
                                <div class="preview">
                                    <div class="mt-4 name">
                                        <label for="vertical-form-1" class="form-label">Nombre</label>
                                        <input id="vertical-form-1" type="text" class="form-control" value="{{ Session::get('data.identity.name'); }}" required>
                                    </div>
                                    <div class="mt-4 lastname">
                                        <label for="vertical-form-2" class="form-label">Apellido</label>
                                        <input id="vertical-form-2" type="text" class="form-control" value="{{ Session::get('data.identity.surname'); }}" required>
                                    </div>
                                    <div class="mt-4 password">
                                        <label for="vertical-form-4" class="form-label">Password</label>
                                        <input id="vertical-form-4" type="text" class="form-control" value="{{ Session::get('data.password'); }}" >
                                    </div>
                                    <div class="grid grid-cols-12 gap-6">
                                        <button class="btn btn-primary mt-5 col-span-6">Guardar</button>
                                        <a id="programmatically-hide-slide-over" href="javascript:;" class="btn btn-secondary col-span-6 mt-5">Cancelar</a> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="dist/js/app.js"></script>
        <script src="{{ asset('../dist/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
        <script>
            $( document ).ready(function() {

                $('button.guardar').unbind().click(function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '../datosUsuario/guardar',
                        data: "",
                        error: function () {
                            alert('Error al guardar los datos');
                        }
                    }).done(function (data) {
                        if (!data || !data.code || data.code != 200) {
                            if(!data || !data.message)
                            alert('Error al guardar los datos');
                            else
                            alert(data.message);

                            return false;
                        }

                        alert('Registro guardado exitosamente')
                    });
                });
                
                $('.modal form').unbind().on('submit', function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '../datosUsuario/editar',
                        data: {
                            'name': $('.modal form .name input').val(),
                            'lastname': $('.modal form .lastname input').val(),
                            'password': $('.modal form .password input').val()
                        },
                        error: function () {
                            alert('Error al actualizar los datos');
                        }
                    }).done(function (data) {
                        if (!data || !data.code || data.code != 200) {
                            if(!data || !data.message)
                            alert('Error al actualizar los datos');
                            else
                            alert(data.message);

                            return false;
                        }

                        alert('Datos actualizados exitosamente')
                    });

                    return false;
                });
            });
        </script>
    </body>
</html>