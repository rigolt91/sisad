<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Usuario', 'url' => ''],
        ['title' => 'Nuevo Usuario', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-plus"></i> Nuevo de usuario
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        <form wire:submit.prevent='update'>
            <div class="row">
                <div class="col">
                    <div class="card bg-dark text-light shadow">
                        <div class="card-body">
                            <div class="card-header h5 py-3 border-primary-bottom mb-3 px-0"><i class="fa fa-user fa-lg me-2"></i> Datos del usuario</div>

                            <div class="form-group mb-3">
                                <label for="name" class="form-label-control mb-2 fw-bold">Nombre de usuario:</label>
                                <input wire:model='name' type="text" class="@error('name') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba el nombre de usuario">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label-control mb-2 fw-bold">Correo electrónico:</label>
                                <input wire:model='email' type="text" class="@error('email') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba dirección de correo electrónico">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="role" class="form-label-control mb-2 fw-bold">Rol de usuario:</label>
                                <select wire:model='role' class="@error('role') is-invalid border-danger @enderror form-select bg-dark text-secondary">
                                    <option value="" disabled selected>Seleccione un rol para el usuario</option>
                                    <option value="tecnico">Técnico</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-dark text-light shadow">
                        <div class="card-body">
                            <div class="card-header h5 py-3 border-primary-bottom mb-3 px-0"><i class="fa fa-edit fa-lg me-2"></i>Contraseña de usuario</div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label-control mb-2 fw-bold">Contraseña:</label>
                                <input wire:model='password' type="password" class="@error('password') is-invalid border-danger @enderror form-control bg-dark text-light">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password-confirm" class="form-label-control mt-1 mb-2 fw-bold">Confirmar contraseña:</label>
                                <input wire:model='password_confirmation' type="password" class="@error('password_confirmation') is-invalid border-danger @enderror form-control bg-dark text-light">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="border-primary-top my-4"></div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary float-end mb-2">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
