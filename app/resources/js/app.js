import 'bootstrap';
import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const albums = window.albumsData || [];

    if (albums.length === 0) return;

    const modalEl = document.getElementById('infoModal');
    const modal = new bootstrap.Modal(modalEl);
    const modalTitle = document.getElementById('modalTitle');
    const modalText = document.getElementById('modalText');
    const modalImg = document.getElementById('modalImg');
    
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;

    function renderModal(index) {
        const a = albums[index];
        modalTitle.textContent = `${a.title} — ${a.artist}`;
        
        let tracksHtml = '';
        if (a.tracks) {
            const tracks = a.tracks.split('\n').filter(t => t.trim() !== '');
            tracksHtml = '<ul class="tracklist mt-2">';
            tracks.forEach(t => { tracksHtml += `<li>${t}</li>`; });
            tracksHtml += '</ul>';
        }

        modalText.innerHTML = `
            <strong>${a.label}</strong><br>
            ${a.full_description || ''}<br><br>
            <em>Треки:</em>
            ${tracksHtml}
        `;

        if (a.cover_image) {
            if (a.cover_image.startsWith('http')) {
                modalImg.src = a.cover_image;
            } else {
                modalImg.src = `/storage/${a.cover_image}`;
            }
            modalImg.style.display = 'block';
        } else {
            modalImg.style.display = 'none';
        }
    }

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            currentIndex = Number(btn.dataset.index);
            renderModal(currentIndex);
            modal.show();
        });
    });

    document.addEventListener('keydown', (e) => {
        if (!modalEl.classList.contains('show')) return;

        if (e.key === 'ArrowRight') {
            currentIndex = (currentIndex + 1) % albums.length;
            renderModal(currentIndex);
        } else if (e.key === 'ArrowLeft') {
            currentIndex = (currentIndex - 1 + albums.length) % albums.length;
            renderModal(currentIndex);
        }
    });

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + albums.length) % albums.length;
            renderModal(currentIndex);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % albums.length;
            renderModal(currentIndex);
        });
    }
});