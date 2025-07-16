<form action="index.php?action=adicionar" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <input type="text" name="descricao" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Link (opcional)</label>
        <input type="url" name="link" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Foto (opcional)</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>