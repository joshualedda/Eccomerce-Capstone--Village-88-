<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($pagination['currentPage'] > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?= base_url('categories/index?page=' . ($pagination['currentPage'] - 1)) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="visually-hidden">Previous</span>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
            <li class="page-item <?= ($pagination['currentPage'] == $i) ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('categories/index?page=' . $i) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
            <li class="page-item">
                <a class="page-link" href="<?= base_url('categories/index?page=' . ($pagination['currentPage'] + 1)) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="visually-hidden">Next</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
