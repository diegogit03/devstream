<?php $this->layout('layout') ?>

<?php $this->start('main') ?>
    <form action="<?= $stream ? "/streams/{$stream->id}?_method=PUT" : '/streams' ?>" method="POST" class="row">
        <div class="col">
            <div class="mb-2">
                <label for="title">Titulo:</label>
                <input class="form-control" type="text" name="title" id="title" value="<?= $stream->title ?? '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Salvar</button>
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
    <script>
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
    </script>
<?php $this->stop() ?>
