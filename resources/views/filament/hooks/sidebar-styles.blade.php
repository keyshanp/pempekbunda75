<style>
    /* ============================
       CUSTOM SIDEBAR STYLING
       ============================ */
    
    /* Sidebar Container */
    .fi-sidebar {
        background: linear-gradient(180deg, #FDFBF7 0%, #F9F5E7 100%) !important;
        border-right: 3px solid #BC5A42 !important;
        box-shadow: 5px 0 15px rgba(188, 90, 66, 0.1) !important;
    }
    
    /* Sidebar Header */
    .fi-sidebar-header {
        background: linear-gradient(135deg, #BC5A42 0%, #9C4A32 100%) !important;
        padding: 2rem 1.5rem !important;
        border-bottom: 3px solid #8C9440 !important;
        text-align: center !important;
    }
    
    .fi-sidebar-header h2 {
        font-family: 'Patrick Hand', cursive !important;
        font-size: 2.5rem !important;
        color: white !important;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2) !important;
        line-height: 1 !important;
        margin: 0 !important;
    }
    
    .fi-sidebar-header .brand-subtitle {
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.8rem !important;
        color: #FFE5B4 !important;
        margin-top: -5px !important;
    }
    
    .brand-divider {
        height: 3px !important;
        width: 60px !important;
        background: #8C9440 !important;
        margin: 10px auto !important;
        border-radius: 10px !important;
    }
    
    /* Navigation Groups */
    .fi-sidebar-group {
        margin-top: 2rem !important;
        padding: 0 1rem !important;
    }
    
    .fi-sidebar-group-label {
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.3rem !important;
        color: #BC5A42 !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        margin-bottom: 1rem !important;
        padding-left: 0.5rem !important;
        border-left: 4px solid #8C9440 !important;
    }
    
    /* Navigation Items */
    .fi-sidebar-item {
        border-radius: 15px !important;
        margin: 0.5rem 0.75rem !important;
        padding: 1rem 1.25rem !important;
        font-family: 'Patrick Hand', cursive !important;
        font-size: 1.3rem !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 2px solid transparent !important;
        position: relative !important;
        overflow: hidden !important;
    }
    
    .fi-sidebar-item:hover {
        background: linear-gradient(135deg, #8C9440 0%, #7C8430 100%) !important;
        color: white !important;
        transform: translateX(10px) scale(1.02) !important;
        box-shadow: 0 5px 15px rgba(140, 148, 64, 0.3) !important;
        border-color: #8C9440 !important;
    }
    
    .fi-sidebar-item:hover .fi-icon {
        color: white !important;
        transform: scale(1.2) !important;
    }
    
    .fi-sidebar-item-active {
        background: linear-gradient(135deg, #BC5A42 0%, #9C4A32 100%) !important;
        color: white !important;
        box-shadow: 0 5px 20px rgba(188, 90, 66, 0.4) !important;
        border-color: #BC5A42 !important;
        transform: translateX(5px) !important;
    }
    
    .fi-sidebar-item-active::before {
        content: '' !important;
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        bottom: 0 !important;
        width: 5px !important;
        background: #FFE5B4 !important;
        border-radius: 0 5px 5px 0 !important;
    }
    
    .fi-sidebar-item-active .fi-icon {
        color: white !important;
        animation: iconBounce 0.5s ease !important;
    }
    
    @keyframes iconBounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.3); }
    }
    
    /* Icons */
    .fi-icon {
        transition: all 0.3s ease !important;
        color: #BC5A42 !important;
    }
    
    .fi-sidebar-item-active .fi-icon {
        color: white !important;
    }
    
    /* Collapsed Sidebar */
    .fi-sidebar.is-collapsed .fi-sidebar-header {
        padding: 1.5rem 0.5rem !important;
    }
    
    .fi-sidebar.is-collapsed .fi-sidebar-header h2 {
        font-size: 1.5rem !important;
        writing-mode: vertical-rl !important;
        text-orientation: mixed !important;
        transform: rotate(180deg) !important;
    }
    
    /* User Menu in Sidebar */
    .fi-sidebar-user-menu {
        margin-top: auto !important;
        padding: 1.5rem !important;
        border-top: 2px solid #BC5A42 !important;
        background: rgba(188, 90, 66, 0.05) !important;
    }
    
    .fi-sidebar-user-avatar {
        border: 3px solid #BC5A42 !important;
        box-shadow: 0 4px 10px rgba(188, 90, 66, 0.3) !important;
        transition: all 0.3s ease !important;
    }
    
    .fi-sidebar-user-avatar:hover {
        transform: scale(1.1) !important;
        border-color: #8C9440 !important;
    }
    
    /* Footer in Sidebar */
    .fi-sidebar-footer {
        padding: 1rem !important;
        text-align: center !important;
        font-family: 'Patrick Hand', cursive !important;
        font-size: 0.9rem !important;
        color: #4A3B34 !important;
        background: rgba(140, 148, 64, 0.1) !important;
        border-radius: 10px !important;
        margin: 1rem !important;
    }
    
    .made-with-love {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
    }
    
    .heart-icon {
        color: #BC5A42 !important;
        animation: heartbeat 1.5s infinite !important;
    }
    
    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>