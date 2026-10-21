<div id="company-content" style="display: <?= $activeModule ? 'block' : 'none' ?>;">
    <div class="content-header">
        <h1>Kelola Modul Company</h1>
        <p class="welcome-text">Tambahkan dan kelola konten halaman company</p>
    </div>

    <?php if ($companyMessage !== ''): ?>
        <div class="alert <?= str_contains(strtolower($companyMessage), 'berhasil') ? 'alert-success' : 'alert-error' ?>" style="display:block"><?= e($companyMessage) ?></div>
    <?php endif; ?>

    <div class="video-section">
        <h2 class="section-title"><?= $companyEditId ? 'Edit Company (ID ' . e($companyEditId) . ')' : 'Tambah Company Baru' ?></h2>
        <form id="company-form" method="post" action="dashboard.php?module=company">
            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="company_action" value="save">
            <?php if ($companyEditId): ?><input type="hidden" name="id" value="<?= e($companyEditId) ?>"><?php endif; ?>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_locale" class="form-label">Locale:</label>
                    <input type="text" id="company_locale" name="locale" class="form-input" maxlength="10" placeholder="contoh: id, en" value="<?= e($companyFormData['locale']) ?>" required>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_seo_title" class="form-label">SEO Title:</label>
                    <input type="text" id="company_seo_title" name="seo_title" class="form-input" maxlength="255" value="<?= e($companyFormData['seo_title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_seo_description" class="form-label">SEO Description:</label>
                    <textarea id="company_seo_description" name="seo_description" class="form-input" rows="3"><?= e($companyFormData['seo_description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="company_seo_keywords" class="form-label">SEO Keywords:</label>
                    <textarea id="company_seo_keywords" name="seo_keywords" class="form-input" rows="2" placeholder="pisahkan dengan koma"><?= e($companyFormData['seo_keywords']) ?></textarea>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_hero_title" class="form-label">Hero Title:</label>
                    <input type="text" id="company_hero_title" name="hero_title" class="form-input" maxlength="255" value="<?= e($companyFormData['hero_title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_hero_lead" class="form-label">Hero Lead:</label>
                    <textarea id="company_hero_lead" name="hero_lead" class="form-input" rows="3"><?= e($companyFormData['hero_lead']) ?></textarea>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_kicker" class="form-label">Kicker:</label>
                    <input type="text" id="company_kicker" name="kicker" class="form-input" maxlength="255" value="<?= e($companyFormData['kicker']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_title" class="form-label">Title:</label>
                    <input type="text" id="company_title" name="title" class="form-input" maxlength="255" value="<?= e($companyFormData['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_lead" class="form-label">Lead:</label>
                    <textarea id="company_lead" name="lead" class="form-input" rows="3"><?= e($companyFormData['lead']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="company_items" class="form-label">Items (JSON):</label>
                    <textarea id="company_items" name="items" class="form-input form-json" rows="5" placeholder='[{"title": "...", "text": "..."}]' required><?= e($companyFormData['items']) ?></textarea>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_operations_kicker" class="form-label">Operations Kicker:</label>
                    <input type="text" id="company_operations_kicker" name="operations_kicker" class="form-input" maxlength="255" value="<?= e($companyFormData['operations_kicker']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_operations_title" class="form-label">Operations Title:</label>
                    <input type="text" id="company_operations_title" name="operations_title" class="form-input" maxlength="255" value="<?= e($companyFormData['operations_title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_operations_text" class="form-label">Operations Text:</label>
                    <textarea id="company_operations_text" name="operations_text" class="form-input" rows="3"><?= e($companyFormData['operations_text']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="company_operations_locations" class="form-label">Operations Locations (JSON):</label>
                    <textarea id="company_operations_locations" name="operations_locations" class="form-input form-json" rows="5" placeholder='["Jakarta", "Bali"]' required><?= e($companyFormData['operations_locations']) ?></textarea>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_sustainability_kicker" class="form-label">Sustainability Kicker:</label>
                    <input type="text" id="company_sustainability_kicker" name="sustainability_kicker" class="form-input" maxlength="255" value="<?= e($companyFormData['sustainability_kicker']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_sustainability_title" class="form-label">Sustainability Title:</label>
                    <input type="text" id="company_sustainability_title" name="sustainability_title" class="form-input" maxlength="255" value="<?= e($companyFormData['sustainability_title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="company_sustainability_lead" class="form-label">Sustainability Lead:</label>
                    <textarea id="company_sustainability_lead" name="sustainability_lead" class="form-input" rows="3"><?= e($companyFormData['sustainability_lead']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="company_sustainibility_items" class="form-label">Sustainability Items (JSON):</label>
                    <textarea id="company_sustainibility_items" name="sustainibility_items" class="form-input form-json" rows="5" placeholder='[{"title": "...", "text": "..."}]' required><?= e($companyFormData['sustainibility_items']) ?></textarea>
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-group">
                    <label for="company_media" class="form-label">Media (JSON):</label>
                    <textarea id="company_media" name="media" class="form-input form-json" rows="5" placeholder='{"hero": "https://..."}' required><?= e($companyFormData['media']) ?></textarea>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-success"><?= $companyEditId ? 'Update Company' : 'Tambah Company' ?></button>
            <?php if ($companyEditId): ?>
                <a class="btn" href="dashboard.php?module=company">Batal Edit</a>
            <?php else: ?>
                <button type="reset" class="btn">Reset Form</button>
            <?php endif; ?>
        </form>
    </div>

    <div class="video-list">
        <h2 class="section-title">Daftar Company</h2>
        <table class="video-table">
            <thead>
                <tr><th>ID</th><th>Locale</th><th>SEO Title</th><th>Hero Title</th><th>Title</th><th>Dibuat</th><th>Diupdate</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (!$companyRows): ?>
                    <tr><td colspan="8" style="text-align:center;color:#7f8c8d">Belum ada data company</td></tr>
                <?php else: foreach ($companyRows as $row): ?>
                    <tr>
                        <td><?= e($row['id']) ?></td><td><?= e($row['locale']) ?></td><td><?= e($row['seo_title']) ?></td><td><?= e($row['hero_title']) ?></td><td><?= e($row['title']) ?></td>
                        <td><?= e($row['created_at']) ?></td><td><?= e($row['update_at']) ?></td>
                        <td>
                            <a class="btn btn-warning btn-small" href="dashboard.php?module=company&amp;edit=<?= e($row['id']) ?>">Edit</a>
                            <form method="post" action="dashboard.php?module=company" style="display:inline" onsubmit="return confirm('Hapus data Company ini?')">
                                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="company_action" value="delete">
                                <input type="hidden" name="id" value="<?= e($row['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-small">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
