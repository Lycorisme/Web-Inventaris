@extends('layouts.main')

@section('page-title', 'Data Kendaraan')

@section('page-content')
<!-- Title and Actions -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Unit Breakdown</h2>
    <div style="display: flex; gap: 10px;">
        <button onclick="openModal()" style="padding: 10px 16px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fas fa-plus"></i> Tambah Baru
        </button>
        <a href="{{ route('kendaraan.breakdown.export') }}" style="padding: 10px 16px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
            <i class="fas fa-download"></i> Export Excel
        </a>
    </div>
</div>

<!-- Table -->
<div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white;">
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">No</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">No Lambung</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Tipe Unit</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Register Number</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Status</th>
                <th style="padding: 16px; text-align: center; font-size: 13px; font-weight: 600;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kendaraan as $item)
            <tr style="border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='white'">
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $loop->iteration }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $item->no_lambung }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $item->tipe_unit }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $item->register_number }}</td>
                <td style="padding: 16px; border-right: 1px solid #e2e8f0;">
                    @if($item->status_komisioning === 'aktif')
                        <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 12px;">Aktif</span>
                    @elseif($item->status_komisioning === 'tidak_aktif')
                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 12px;">Tidak Aktif</span>
                    @else
                        <span style="background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 12px;">Maintenance</span>
                    @endif
                </td>
                <td style="padding: 16px; text-align: center;">
                    <button onclick="openEditModal({{ $item->id }})" style="background: none; border: none; color: #2563eb; cursor: pointer; font-size: 16px; margin-right: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="POST" action="{{ route('kendaraan.breakdown.destroy', $item->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 16px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr style="border-bottom: 1px solid #e2e8f0;">
                <td colspan="6" style="padding: 16px; text-align: center; color: #94a3b8; font-size: 13px;">Tidak ada data kendaraan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 0 20px;">
    <div style="font-size: 13px; color: #64748b;">Total: {{ $kendaraan->total() }} data</div>
    <div style="display: flex; gap: 10px; align-items: center;">
        @if($kendaraan->onFirstPage())
            <button disabled style="padding: 6px 12px; background: #f0f4f8; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: not-allowed; color: #cbd5e1;">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $kendaraan->previousPageUrl() }}" style="padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.3s ease; text-decoration: none; color: #334155;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif
        <span style="font-size: 13px; color: #334155; font-weight: 600;">{{ $kendaraan->currentPage() }} / {{ $kendaraan->lastPage() }}</span>
        @if($kendaraan->hasMorePages())
            <a href="{{ $kendaraan->nextPageUrl() }}" style="padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.3s ease; text-decoration: none; color: #334155;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <button disabled style="padding: 6px 12px; background: #f0f4f8; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: not-allowed; color: #cbd5e1;">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
</div>

<!-- Add Modal -->
<div id="formModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; flex-direction: column;">
    <div style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; animation: slideIn 0.3s ease;">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Tambah Data Kendaraan</h2>
            <button onclick="closeModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 30px;">
            <form method="POST" action="{{ route('kendaraan.breakdown.store') }}" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">No Lambung</label>
                    <input type="text" name="no_lambung" placeholder="Masukkan No Lambung" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tipe Unit</label>
                    <input type="text" name="tipe_unit" placeholder="Masukkan Tipe Unit" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Register Number</label>
                    <input type="text" name="register_number" placeholder="Masukkan Register Number" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Status Komisioning</label>
                    <select name="status_komisioning" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeModal()" style="padding: 10px 24px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; flex-direction: column;">
    <div style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; animation: slideIn 0.3s ease;">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Edit Data Unit Breakdown</h2>
            <button onclick="closeEditModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 30px;">
            <form id="editForm" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                @method('PUT')

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">No Lambung</label>
                    <input type="text" id="editNoLambung" name="no_lambung" placeholder="Masukkan No Lambung" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tipe Unit</label>
                    <input type="text" id="editTipeUnit" name="tipe_unit" placeholder="Masukkan Tipe Unit" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Register Number</label>
                    <input type="text" id="editRegisterNumber" name="register_number" placeholder="Masukkan Register Number" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Status Komisioning</label>
                    <select id="editStatus" name="status_komisioning" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeEditModal()" style="padding: 10px 24px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                        <i class="fas fa-pencil"></i> Edit
                    </button>
                </div>
            </form>
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
</style>

<script>
function openModal() {
    const modal = document.getElementById('formModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('formModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function openEditModal(id) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    // Fetch data from server
    fetch(`/data/kendaraan/breakdown/${id}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('editNoLambung').value = data.no_lambung;
        document.getElementById('editTipeUnit').value = data.tipe_unit;
        document.getElementById('editRegisterNumber').value = data.register_number;
        document.getElementById('editStatus').value = data.status_komisioning;
        form.action = `/data/kendaraan/breakdown/${id}`;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    })
    .catch(error => console.error('Error:', error));
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modals when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const addModal = document.getElementById('formModal');
    const editModal = document.getElementById('editModal');

    if (addModal) {
        addModal.addEventListener('click', function(e) {
            if (e.target === addModal) {
                closeModal();
            }
        });
    }

    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === editModal) {
                closeEditModal();
            }
        });
    }
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
        closeEditModal();
    }
});
</script>
@endsection
