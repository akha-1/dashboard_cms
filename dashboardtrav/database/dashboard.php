<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
require __DIR__ . '/db.php';

$companyFields = [
    'locale', 'seo_title', 'seo_description', 'seo_keywords', 'hero_title', 'hero_lead',
    'kicker', 'title', 'lead', 'items', 'operations_kicker', 'operations_title',
    'operations_text', 'operations_locations', 'sustainability_kicker',
    'sustainability_title', 'sustainability_lead', 'sustainibility_items', 'media'
];
$companyJsonFields = ['items', 'operations_locations', 'sustainibility_items', 'media'];
$companyDefaults = array_fill_keys($companyFields, '');
$companyDefaults['items'] = '[]';
$companyDefaults['operations_locations'] = '[]';
$companyDefaults['sustainibility_items'] = '[]';
$companyDefaults['media'] = '{}';
$companyFormData = $companyDefaults;
$companyEditId = null;
$companyMessage = $_SESSION['company_message'] ?? '';
unset($_SESSION['company_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid($_POST['csrf'] ?? '')) {
        $companyMessage = 'Token keamanan tidak valid. Muat ulang halaman lalu coba lagi.';
    } else {
        $action = $_POST['company_action'] ?? 'save';

        try {
            if ($action === 'delete') {
                $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
                if (!$id || $id < 1) {
                    throw new RuntimeException('ID Company tidak valid.');
                }
                $stmt = $pdo->prepare('DELETE FROM company WHERE id = ?');
                $stmt->execute([$id]);
                $_SESSION['company_message'] = $stmt->rowCount() ? 'Company berhasil dihapus.' : 'Data Company tidak ditemukan.';
                header('Location: dashboard.php?module=company');
                exit;
            }

            foreach ($companyFields as $field) {
                $companyFormData[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
            }
            foreach ($companyJsonFields as $field) {
                json_decode($companyFormData[$field]);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new RuntimeException('Format JSON pada ' . $field . ' tidak valid.');
                }
            }

            $postedId = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            if ($postedId && $postedId > 0) {
                $assignments = implode(', ', array_map(static fn($field) => "$field = :$field", $companyFields));
                $stmt = $pdo->prepare("UPDATE company SET $assignments, update_at = NOW() WHERE id = :id");
                foreach ($companyFields as $field) {
                    $stmt->bindValue(':' . $field, $companyFormData[$field]);
                }
                $stmt->bindValue(':id', $postedId, PDO::PARAM_INT);
                $stmt->execute();
                $_SESSION['company_message'] = 'Company berhasil diperbarui.';
            } else {
                $columns = implode(', ', $companyFields);
                $placeholders = ':' . implode(', :', $companyFields);
                $stmt = $pdo->prepare("INSERT INTO company ($columns, created_at, update_at) VALUES ($placeholders, NOW(), NOW())");
                foreach ($companyFields as $field) {
                    $stmt->bindValue(':' . $field, $companyFormData[$field]);
                }
                $stmt->execute();
                $_SESSION['company_message'] = 'Company berhasil ditambahkan.';
            }

            header('Location: dashboard.php?module=company');
            exit;
        } catch (RuntimeException $e) {
            $companyMessage = $e->getMessage();
            $companyEditId = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT) ?: null;
        } catch (PDOException $e) {
            error_log('Company tradisional: ' . $e->getMessage());
            $companyMessage = 'Penyimpanan gagal. Periksa koneksi database dan struktur tabel Company.';
            $companyEditId = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT) ?: null;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && isset($_GET['edit'])) {
    $id = filter_var($_GET['edit'], FILTER_VALIDATE_INT);
    if ($id && $id > 0) {
        $stmt = $pdo->prepare('SELECT * FROM company WHERE id = ?');
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        if ($record) {
            $companyFormData = array_merge($companyDefaults, $record);
            $companyEditId = (int)$record['id'];
        } else {
            $companyMessage = 'Data Company tidak ditemukan.';
        }
    }
}

$companyRows = $pdo->query('SELECT * FROM company ORDER BY id DESC')->fetchAll();
$activeModule = ($_GET['module'] ?? '') === 'company' || $companyEditId !== null || $_SERVER['REQUEST_METHOD'] === 'POST';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/sidebar.php';
?>
        <main class="main-content">
<?php include __DIR__ . '/pages/dashboard.php'; ?>
<?php include __DIR__ . '/pages/company.php'; ?>
        </main>
<script src="includes/tinymce/js/tinymce/tinymce.min.js"></script>
<?php require __DIR__ . '/includes/footer.php'; ?>
