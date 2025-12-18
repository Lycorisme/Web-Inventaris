<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
    <div style="display: flex; align-items: center; gap: 12px;">
        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px;">
            <i class="fas fa-user"></i>
        </div>
        <div>
            <div style="font-weight: 600; font-size: 14px; color: #1e293b;">{{ Auth::user()->name }}</div>
            <div style="font-size: 12px; color: #94a3b8;">{{ Auth::user()->address ?? 'General Affair' }}</div>
        </div>
    </div>
    <h1 style="font-size: 24px; font-weight: 700; color: #1e293b;">@yield('page-title', 'Dashboard')</h1>
    <a href="{{ route('logout.confirm') }}" style="padding: 10px 20px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>
