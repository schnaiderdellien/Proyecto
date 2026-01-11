<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="mb-4">¿Has olvidado tu contraseña?</h4>

                    <form action="send_reset.php" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Enviar enlace de recuperación
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
