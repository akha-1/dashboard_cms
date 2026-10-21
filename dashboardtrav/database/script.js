function showPanel(name) {
    const dashboard = document.getElementById('dashboard-content');
    const company = document.getElementById('company-content');
    if (dashboard) dashboard.style.display = name === 'dashboard' ? 'block' : 'none';
    if (company) company.style.display = name === 'company' ? 'block' : 'none';
}

function showDashboard() {
    showPanel('dashboard');
    updateActiveNav(0);
}

function showCompanyModule() {
    showPanel('company');
    updateActiveNav(1);
}

function updateActiveNav(activeIndex) {
    document.querySelectorAll('.nav-link').forEach((link, index) => {
        link.classList.toggle('active', index === activeIndex);
    });
}

function logout() {
    if (!confirm('Apakah Anda yakin ingin logout?')) return;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'logout.php';
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'csrf';
    input.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}

if (window.tinymce) {
    tinymce.init({
        selector: [
            '#company_hero_lead',
            '#company_lead',
            '#company_operations_text',
            '#company_sustainability_lead'
        ].join(', '),
        menubar: true,
        plugins: 'lists link image media table',
        toolbar: 'undo redo | blocks | bold italic | bullist numlist | link',
        license_key: 'gpl'
    });

    document.getElementById('company-form')?.addEventListener('submit', function() {
        tinymce.triggerSave();
    });

    document.getElementById('company-form')?.addEventListener('reset', function() {
        setTimeout(() => {
            tinymce.editors.forEach(editor => editor.setContent(editor.getElement().value || ''));
        }, 0);
    });
}
