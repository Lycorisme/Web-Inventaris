<!-- Modal Overlay -->
<div id="formModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
    <!-- Modal Content -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; animation: slideIn 0.3s ease;">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">@yield('modal-title', 'Form')</h2>
            <button onclick="closeModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 30px;">
            @yield('modal-content')
        </div>
    </div>
</div>

<style>
    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #formModal {
        display: none !important;
    }

    #formModal.show {
        display: flex !important;
    }
</style>

<script>
function openModal() {
    const modal = document.getElementById('formModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('formModal');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('formModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
