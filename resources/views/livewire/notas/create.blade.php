<div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark  shadow">
                <div class="modal-header bg-primary text-white fw-bold">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil fa-lg me-3"></i> Nueva Anotación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('nota.create') }}" method="POST">
                    <div class="modal-body text-white">

                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Titulo:</label>
                                <input name="titulo" type="text" placeholder="Escriba título de la anotación" class="form-control bg-dark text-light" id="recipient-name" required>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Texto:</label>
                                <textarea name="texto" class="form-control bg-dark text-light" placeholder="Escriba el texto de la anotación" id="message-text" required></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar anotación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
