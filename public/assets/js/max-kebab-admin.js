document.addEventListener('DOMContentLoaded', function () {
    var flashToasts = document.querySelectorAll('[data-flash-toast]');

    function closeFlashToast(toast) {
        if (!toast || toast.classList.contains('is-closing')) {
            return;
        }

        toast.classList.add('is-closing');

        window.setTimeout(function () {
            toast.remove();
        }, 260);
    }

    flashToasts.forEach(function (toast) {
        var dismissButton = toast.querySelector('[data-flash-dismiss]');

        if (dismissButton) {
            dismissButton.addEventListener('click', function () {
                closeFlashToast(toast);
            });
        }
    });

    if (flashToasts.length) {
        window.setTimeout(function () {
            document.querySelectorAll('[data-flash-toast]').forEach(closeFlashToast);
        }, 4600);
    }

    var primaryImageInput = document.querySelector('[data-image-preview-input]');
    var primaryImageTarget = document.querySelector('[data-image-preview-target]');
    var primaryImagePathInput = document.querySelector('[data-image-path-input]');
    var galleryImageInput = document.querySelector('[data-gallery-preview-input]');
    var galleryPreviewTarget = document.querySelector('[data-gallery-preview-target]');
    var assetBase = primaryImageTarget ? primaryImageTarget.dataset.assetBase || '/' : '/';

    function renderPrimaryPlaceholder() {
        if (!primaryImageTarget) {
            return;
        }

        primaryImageTarget.innerHTML = '<span>Primary preview</span>';
    }

    function renderPrimaryPreviewFromSrc(src) {
        if (!primaryImageTarget || !src) {
            return;
        }

        primaryImageTarget.innerHTML = '';
        var image = document.createElement('img');
        image.src = src;
        image.alt = 'Primary preview';
        primaryImageTarget.appendChild(image);
    }

    function renderPrimaryPreview(file) {
        if (!file) {
            return;
        }

        renderPrimaryPreviewFromSrc(URL.createObjectURL(file));
    }

    function resolvePreviewPath(value) {
        var path = (value || '').trim();

        if (!path) {
            return null;
        }

        if (/^(https?:|data:|blob:)/i.test(path) || path.charAt(0) === '/') {
            return path;
        }

        return assetBase + path.replace(/^\/+/, '');
    }

    function renderGalleryPreview(files) {
        if (!galleryPreviewTarget) {
            return;
        }

        galleryPreviewTarget.innerHTML = '';

        if (!files || !files.length) {
            var emptyState = document.createElement('div');
            emptyState.className = 'admin-gallery-empty';
            emptyState.textContent = 'Upload additional product shots or keep a single strong image.';
            galleryPreviewTarget.appendChild(emptyState);
            return;
        }

        Array.from(files).forEach(function (file) {
            var thumb = document.createElement('div');
            thumb.className = 'admin-gallery-thumb';

            var image = document.createElement('img');
            image.src = URL.createObjectURL(file);
            image.alt = file.name;

            thumb.appendChild(image);
            galleryPreviewTarget.appendChild(thumb);
        });
    }

    if (primaryImageInput) {
        primaryImageInput.addEventListener('change', function () {
            var file = primaryImageInput.files && primaryImageInput.files[0];

            if (file) {
                renderPrimaryPreview(file);
            }
        });
    }

    if (primaryImagePathInput) {
        primaryImagePathInput.addEventListener('input', function () {
            if (primaryImageInput && primaryImageInput.files && primaryImageInput.files.length) {
                return;
            }

            var previewPath = resolvePreviewPath(primaryImagePathInput.value);

            if (previewPath) {
                renderPrimaryPreviewFromSrc(previewPath);
                return;
            }

            renderPrimaryPlaceholder();
        });
    }

    if (galleryImageInput) {
        galleryImageInput.addEventListener('change', function () {
            renderGalleryPreview(galleryImageInput.files);
        });
    }

    var confirmShell = document.querySelector('[data-admin-confirm]');

    if (!confirmShell) {
        return;
    }

    var messageNode = confirmShell.querySelector('[data-admin-confirm-message]');
    var detailNode = confirmShell.querySelector('[data-admin-confirm-detail]');
    var acceptButton = confirmShell.querySelector('[data-admin-confirm-accept]');
    var cancelButtons = confirmShell.querySelectorAll('[data-admin-confirm-cancel]');
    var pendingForm = null;

    function closeConfirm() {
        confirmShell.classList.remove('is-visible');
        confirmShell.setAttribute('hidden', 'hidden');
        pendingForm = null;
    }

    function openConfirm(form) {
        pendingForm = form;
        messageNode.textContent = form.dataset.confirm || 'Are you sure you want to continue?';
        detailNode.textContent = form.dataset.confirmDetail || '';
        detailNode.style.display = detailNode.textContent ? 'block' : 'none';
        confirmShell.removeAttribute('hidden');
        window.requestAnimationFrame(function () {
            confirmShell.classList.add('is-visible');
        });
    }

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.confirmed === 'true') {
                form.dataset.confirmed = 'false';
                return;
            }

            event.preventDefault();
            openConfirm(form);
        });
    });

    cancelButtons.forEach(function (button) {
        button.addEventListener('click', closeConfirm);
    });

    acceptButton.addEventListener('click', function () {
        if (!pendingForm) {
            closeConfirm();
            return;
        }

        pendingForm.dataset.confirmed = 'true';
        pendingForm.requestSubmit();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && confirmShell.classList.contains('is-visible')) {
            closeConfirm();
        }
    });
});
