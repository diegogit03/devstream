<?php $this->layout('layout') ?>

<?php $this->start('assets') ?>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
<?php $this->end() ?>

<?php $this->start('main') ?>
    <form enctype="multipart/form-data" action="<?= ($stream ?? false) ? "/streams/{$stream->id}?_method=PUT" : '/streams' ?>" method="POST" class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <label class="form-label" for="image">Imagem:</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="title">Titulo:</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?= $stream->title ?? '' ?>" required>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </div>
        </div>
        <?php if ($stream ?? '') { ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <label for="">Chave de transmissão</label>
                        <div class="input-group">
                            <input id="record" class="form-control" type="password" value="<?= $stream->record_id ?>" readonly>
                            <button id="toggleRecord" type="button" class="input-group-text bi bi-eye-slash"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
<?php $this->stop() ?>

<?php $this->start('scripts') ?>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const inputElement = document.querySelector('#image');

        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*'],
            storeAsFile: true,
            required: true,
            name: 'image',
        });

        <?php if ($stream ?? '') { ?>
            pond.addFile('/uploads/<?= $stream->image_filename ?>')

            const toggleRecord = document.querySelector("#toggleRecord");
            const input = document.querySelector("#record");

            toggleRecord.addEventListener("click", function () {

                // toggle the type attribute
                const type = input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);
                // toggle the eye icon
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        <?php } ?>
    </script>
<?php $this->stop() ?>
