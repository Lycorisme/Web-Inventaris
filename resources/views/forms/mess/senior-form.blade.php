@extends('layouts.form')

@section('form-title', 'Form Tambah Data Mess Senior Staff')

@section('form-content')
<form method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    @csrf

    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">No</label>
            <input type="text" name="no" placeholder="Auto Generated" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; background-color: #f8fafc;" disabled>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Mess</label>
            <input type="text" name="mess" placeholder="Masukkan Nama Mess" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">No Kamar</label>
            <input type="text" name="no_kamar" placeholder="Masukkan No Kamar" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">SN</label>
            <input type="text" name="sn" placeholder="Masukkan SN" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Nama Penghuni</label>
            <input type="text" name="nama_penghuni" placeholder="Masukkan Nama Penghuni" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Dept</label>
            <input type="text" name="dept" placeholder="Masukkan Departemen" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">POH</label>
            <input type="text" name="poh" placeholder="Masukkan POH" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;" required>
        </div>
    </div>

    <div></div>
</form>

<div style="display: flex; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
    <button type="submit" style="padding: 12px 32px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
        <i class="fas fa-plus"></i> Tambah
    </button>
</div>
@endsection
