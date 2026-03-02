<style>
    /* ============================
       FIX DROPDOWN LOGOUT SIZE
       ============================ */
    
    /* Dropdown panel (untuk logout, notifications, dll) */
    .fi-dropdown-panel {
        min-width: 14rem !important;
        max-width: 18rem !important;
        border-radius: 1rem !important;
        border: 2px solid #e2e8f0 !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        margin-top: 0.5rem !important;
        overflow: hidden !important;
        background: white !important;
    }
    
    /* User avatar di topbar */
    .fi-avatar {
        border: 2px solid #0ea5e9 !important;
        transition: all 0.2s ease !important;
    }
    
    .fi-avatar:hover {
        border-color: #0369a1 !important;
        transform: scale(1.05) !important;
    }
    
    /* Dropdown list items */
    .fi-dropdown-list {
        padding: 0.5rem !important;
    }
    
    .fi-dropdown-item {
        border-radius: 0.75rem !important;
        margin: 0.25rem 0 !important;
        padding: 0.75rem 1rem !important;
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.1rem !important;
        transition: all 0.2s ease !important;
        color: #334155 !important;
    }
    
    .fi-dropdown-item:hover {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
        color: #0369a1 !important;
        transform: translateX(4px) !important;
    }
    
    /* Logout button khusus */
    .fi-dropdown-item.danger {
        color: #dc2626 !important;
        background: transparent !important;
    }
    
    .fi-dropdown-item.danger:hover {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
        color: #b91c1c !important;
    }
    
    /* ============================
       ADMIN THEME STYLING
       ============================ */
    
    /* Topbar - Dark Blue Theme */
    .fi-topbar {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
        border-bottom: 2px solid #334155 !important;
        color: white !important;
    }
    
    /* Sidebar - Dark Theme */
    .fi-sidebar {
        background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%) !important;
        border-right: 2px solid #334155 !important;
        color: white !important;
    }
    
    .fi-sidebar-header {
        background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%) !important;
        color: white !important;
        padding: 1.5rem !important;
        border-bottom: 2px solid #0369a1 !important;
    }
    
    .fi-sidebar-group-label {
        color: #94a3b8 !important;
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.1rem !important;
        margin-top: 1.5rem !important;
        padding-left: 1rem !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
    
    .fi-sidebar-item {
        border-radius: 0.75rem !important;
        margin: 0.25rem 0.75rem !important;
        padding: 0.75rem 1rem !important;
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.1rem !important;
        transition: all 0.2s ease !important;
        color: #cbd5e1 !important;
    }
    
    .fi-sidebar-item:hover {
        background: linear-gradient(135deg, #334155 0%, #475569 100%) !important;
        color: white !important;
        transform: translateX(5px) !important;
    }
    
    .fi-sidebar-item-active {
        background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3) !important;
    }
    
    /* Main content area */
    .fi-main {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    }
</style>