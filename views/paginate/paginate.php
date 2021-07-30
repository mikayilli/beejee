<?php if($paginate['total'] > $paginate['perPage']): ?>
    <div class="row">
        <div class="col-12">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <?php for($i = 0; $i < ceil($paginate['total']/$paginate['perPage']); $i++): ?>
                    <a href="?page=<?= $i + 1 ?>" class="btn btn-outline-primary <?= $paginate['current_page'] == ($i + 1) ? 'active' : null ?>"><?=  $i + 1 ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
