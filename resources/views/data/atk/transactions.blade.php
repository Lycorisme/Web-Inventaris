@extends('layouts.main')

@section('page-title', 'Data ATK')

@section('page-content')
<!-- Title and Actions -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">Transaksi ATK</h2>
    <div style="display: flex; gap: 10px;">
        <button onclick="openModal()" style="padding: 10px 16px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </button>
        <a href="{{ route('atk.transactions.export') }}" style="padding: 10px 16px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
            <i class="fas fa-download"></i> Export Excel
        </a>
    </div>
</div>

<!-- Table -->
<div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); color: white;">
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">No</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Nama Barang</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Tipe</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Jumlah</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Tanggal</th>
                <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.1);">Keterangan</th>
                <th style="padding: 16px; text-align: center; font-size: 13px; font-weight: 600;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr style="border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='white'">
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $loop->iteration }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $transaction->atkItem->nama_barang }}</td>
                <td style="padding: 16px; border-right: 1px solid #e2e8f0;">
                    @if($transaction->tipe_transaksi === 'masuk')
                        <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 12px;">Masuk</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 4px; font-weight: 600; font-size: 12px;">Keluar</span>
                    @endif
                </td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $transaction->jumlah }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $transaction->tanggal_transaksi->format('d-m-Y') }}</td>
                <td style="padding: 16px; font-size: 13px; color: #334155; border-right: 1px solid #e2e8f0;">{{ $transaction->keterangan ?? '-' }}</td>
                <td style="padding: 16px; text-align: center;">
                    <button onclick="openEditModal({{ $transaction->id }})" style="background: none; border: none; color: #2563eb; cursor: pointer; font-size: 16px; margin-right: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="POST" action="{{ route('atk.transactions.destroy', $transaction->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
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
                <td colspan="7" style="padding: 16px; text-align: center; color: #94a3b8; font-size: 13px;">Tidak ada transaksi ATK</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 0 20px;">
    <div style="font-size: 13px; color: #64748b;">Total: {{ $transactions->total() }} transaksi</div>
    <div style="display: flex; gap: 10px; align-items: center;">
        @if($transactions->onFirstPage())
            <button disabled style="padding: 6px 12px; background: #f0f4f8; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: not-allowed; color: #cbd5e1;">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $transactions->previousPageUrl() }}" style="padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.3s ease; text-decoration: none; color: #334155;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif
        <span style="font-size: 13px; color: #334155; font-weight: 600;">{{ $transactions->currentPage() }} / {{ $transactions->lastPage() }}</span>
        @if($transactions->hasMorePages())
            <a href="{{ $transactions->nextPageUrl() }}" style="padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.3s ease; text-decoration: none; color: #334155;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
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
        <div style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Tambah Transaksi</h2>
            <button onclick="closeModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div style="padding: 30px;">
            <form method="POST" action="{{ route('atk.transactions.store') }}" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Barang ATK</label>
                    <select id="atkItemSelect" name="atk_item_id" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required onchange="updateStockInfo()">
                        <option value="">Pilih Barang</option>
                        @foreach(\App\Models\AtkItem::all() as $item)
                            <option value="{{ $item->id }}" data-stok="{{ $item->stok_sekarang }}">{{ $item->nama_barang }} (Stok: {{ $item->stok_sekarang }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tipe Transaksi</label>
                    <select id="tipeTransaksiSelect" name="tipe_transaksi" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required onchange="updateStockInfo()">
                        <option value="">Pilih Tipe</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Jumlah</label>
                    <input type="number" id="jumlahInput" name="jumlah" placeholder="Masukkan Jumlah" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required min="1" onchange="validateJumlah()">
                    <div id="stockWarning" style="display: none; margin-top: 8px; padding: 8px 12px; background: #fee2e2; color: #991b1b; border-radius: 4px; font-size: 12px; font-weight: 600;"></div>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required value="{{ date('Y-m-d') }}">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Keterangan</label>
                    <textarea name="keterangan" placeholder="Masukkan Keterangan (Opsional)" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; resize: vertical; min-height: 60px;"></textarea>
                </div>
                <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeModal()" style="padding: 10px 24px; background: white; color: #6366F1; border: 2px solid #6366F1; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eef2ff'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(99, 102, 241, 0.3)'">
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
        <div style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Edit Transaksi</h2>
            <button onclick="closeEditModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div style="padding: 30px;">
            <form id="editForm" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Barang ATK</label>
                    <select id="editAtkItemId" name="atk_item_id" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                        <option value="">Pilih Barang</option>
                        @foreach(\App\Models\AtkItem::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tipe Transaksi</label>
                    <select id="editTipeTransaksi" name="tipe_transaksi" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Jumlah</label>
                    <input type="number" id="editJumlah" name="jumlah" placeholder="Masukkan Jumlah" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required min="1">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Tanggal Transaksi</label>
                    <input type="date" id="editTanggalTransaksi" name="tanggal_transaksi" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Keterangan</label>
                    <textarea id="editKeterangan" name="keterangan" placeholder="Masukkan Keterangan (Opsional)" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; resize: vertical; min-height: 60px;"></textarea>
                </div>
                <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeEditModal()" style="padding: 10px 24px; background: white; color: #6366F1; border: 2px solid #6366F1; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eef2ff'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(99, 102, 241, 0.3)'">
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

    fetch(`/data/atk/transactions/${id}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('editAtkItemId').value = data.atk_item_id;
        document.getElementById('editTipeTransaksi').value = data.tipe_transaksi;
        document.getElementById('editJumlah').value = data.jumlah;
        document.getElementById('editTanggalTransaksi').value = data.tanggal_transaksi;
        document.getElementById('editKeterangan').value = data.keterangan || '';
        form.action = `/data/atk/transactions/${id}`;

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

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
        closeEditModal();
    }
});

// Stock validation functions
function updateStockInfo() {
    validateJumlah();
}

function validateJumlah() {
    const atkItemSelect = document.getElementById('atkItemSelect');
    const tipeTransaksiSelect = document.getElementById('tipeTransaksiSelect');
    const jumlahInput = document.getElementById('jumlahInput');
    const stockWarning = document.getElementById('stockWarning');

    if (!atkItemSelect.value || !tipeTransaksiSelect.value) {
        stockWarning.style.display = 'none';
        jumlahInput.max = '';
        return;
    }

    const selectedOption = atkItemSelect.options[atkItemSelect.selectedIndex];
    const stok = parseInt(selectedOption.getAttribute('data-stok'));
    const tipeTransaksi = tipeTransaksiSelect.value;

    if (tipeTransaksi === 'keluar') {
        jumlahInput.max = stok;

        if (jumlahInput.value && parseInt(jumlahInput.value) > stok) {
            stockWarning.textContent = `⚠️ Stok tidak cukup! Stok tersedia: ${stok}`;
            stockWarning.style.display = 'block';
            jumlahInput.style.borderColor = '#dc2626';
        } else {
            stockWarning.style.display = 'none';
            jumlahInput.style.borderColor = '#e2e8f0';
        }
    } else {
        jumlahInput.max = '';
        stockWarning.style.display = 'none';
        jumlahInput.style.borderColor = '#e2e8f0';
    }
}

// Add form submission validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[action*="atk/transactions"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const tipeTransaksi = form.querySelector('[name="tipe_transaksi"]').value;
            const jumlah = parseInt(form.querySelector('[name="jumlah"]').value);
            const atkItemId = form.querySelector('[name="atk_item_id"]').value;

            if (tipeTransaksi === 'keluar' && atkItemId) {
                const selectedOption = document.querySelector(`[name="atk_item_id"] option[value="${atkItemId}"]`);
                const stok = parseInt(selectedOption.getAttribute('data-stok'));

                if (jumlah > stok) {
                    e.preventDefault();
                    alert(`Stok tidak cukup! Stok tersedia: ${stok}, Jumlah yang diminta: ${jumlah}`);
                    return false;
                }
            }
        });
    });
});
</script>
@endsection
