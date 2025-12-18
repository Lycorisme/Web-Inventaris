@extends('layouts.main')

@section('page-title', 'Dashboard')

@section('page-content')
<!-- User Profile Section -->
<div style="margin-bottom: 30px;">
    <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0;">Profil Admin</h2>
            <div style="display: flex; gap: 10px;">
                <button onclick="openEditProfileModal()" style="padding: 8px 16px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-edit"></i> Edit Profil
                </button>
                <button onclick="openChangePasswordModal()" style="padding: 8px 16px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                    <i class="fas fa-key"></i> Ubah Password
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Nama</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->name }}</div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Username</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->username }}</div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Email</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->email }}</div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Nomor Telepon</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->phone_number ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Alamat</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->address ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Jenis Kelamin</div>
                <div style="font-size: 14px; color: #1e293b; font-weight: 500;">{{ Auth::user()->gender ? (Auth::user()->gender === 'male' ? 'Laki-laki' : 'Perempuan') : '-' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section 1 -->
<div style="margin-bottom: 30px;">
    <h2 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">Statistik Data Kendaraan</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <!-- Card 1 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #2563eb; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(37, 99, 235, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Total Kendaraan</div>
                <i class="fas fa-car" style="color: #2563eb; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2563eb;">{{ $totalKendaraan }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Semua unit</div>
        </div>
        <!-- Card 2 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #059669; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(5, 150, 105, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Kendaraan Aktif</div>
                <i class="fas fa-check-circle" style="color: #059669; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #059669;">{{ $kendaraanAktif }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Siap digunakan</div>
        </div>
        <!-- Card 3 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #dc2626; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(220, 38, 38, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Unit Breakdown</div>
                <i class="fas fa-tools" style="color: #dc2626; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #dc2626;">{{ $unitBreakdown }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Dalam perbaikan</div>
        </div>
    </div>
</div>

<!-- Statistics Section 2 -->
<div>
    <h2 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">Statistik Data Mess</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <!-- Card 1 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #7c3aed; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(124, 58, 237, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Senior Staff</div>
                <i class="fas fa-user-tie" style="color: #7c3aed; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #7c3aed;">{{ $messSenior }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Penghuni aktif</div>
        </div>
        <!-- Card 2 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #0891b2; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(8, 145, 178, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Junior Staff</div>
                <i class="fas fa-user" style="color: #0891b2; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #0891b2;">{{ $messJunior }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Penghuni aktif</div>
        </div>
        <!-- Card 3 -->
        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #f59e0b; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 16px rgba(245, 158, 11, 0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-size: 13px; font-weight: 600; color: #64748b;">Non Staff</div>
                <i class="fas fa-users" style="color: #f59e0b; font-size: 18px;"></i>
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #f59e0b;">{{ $messNonStaff }}</div>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">Penghuni aktif</div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; flex-direction: column;">
    <div style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; animation: slideIn 0.3s ease;">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Edit Profil</h2>
            <button onclick="closeEditProfileModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 30px;">
            <form method="POST" action="{{ route('profile.update') }}" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                @method('PUT')

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Nama</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Masukkan Nama" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Username</label>
                    <input type="text" name="username" value="{{ Auth::user()->username }}" placeholder="Masukkan Username" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Masukkan Email" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Nomor Telepon</label>
                    <input type="text" name="phone_number" value="{{ Auth::user()->phone_number }}" placeholder="Masukkan Nomor Telepon" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Jenis Kelamin</label>
                    <select name="gender" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ Auth::user()->gender === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ Auth::user()->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Alamat</label>
                    <textarea name="address" placeholder="Masukkan Alamat" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; resize: vertical; min-height: 80px;">{{ Auth::user()->address }}</textarea>
                </div>

                <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeEditProfileModal()" style="padding: 10px 24px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; flex-direction: column;">
    <div style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; animation: slideIn 0.3s ease;">
        <!-- Modal Header -->
        <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; border-radius: 12px 12px 0 0;">
            <h2 style="font-size: 18px; font-weight: 700; margin: 0;">Ubah Password</h2>
            <button onclick="closeChangePasswordModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 30px;">
            <form method="POST" action="{{ route('password.update') }}" style="display: grid; gap: 20px;">
                @csrf
                @method('PUT')

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Password Lama</label>
                    <input type="password" name="current_password" placeholder="Masukkan Password Lama" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Password Baru</label>
                    <input type="password" name="password" placeholder="Masukkan Password Baru" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px;">
                    <button type="button" onclick="closeChangePasswordModal()" style="padding: 10px 24px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                        Batal
                    </button>
                    <button type="submit" style="padding: 10px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                        <i class="fas fa-key"></i> Ubah Password
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
function openEditProfileModal() {
    const modal = document.getElementById('editProfileModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeEditProfileModal() {
    const modal = document.getElementById('editProfileModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function openChangePasswordModal() {
    const modal = document.getElementById('changePasswordModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeChangePasswordModal() {
    const modal = document.getElementById('changePasswordModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modals when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const editProfileModal = document.getElementById('editProfileModal');
    const changePasswordModal = document.getElementById('changePasswordModal');

    if (editProfileModal) {
        editProfileModal.addEventListener('click', function(e) {
            if (e.target === editProfileModal) {
                closeEditProfileModal();
            }
        });
    }

    if (changePasswordModal) {
        changePasswordModal.addEventListener('click', function(e) {
            if (e.target === changePasswordModal) {
                closeChangePasswordModal();
            }
        });
    }
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditProfileModal();
        closeChangePasswordModal();
    }
});
</script>
@endsection
