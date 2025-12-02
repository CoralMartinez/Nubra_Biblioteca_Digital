/**
 * Sistema de transiciones entre páginas
 * Maneja animaciones slide left/right y fade en móvil
 */

// Rutas y su orden (para determinar dirección de slide)
const routeOrder = [
    '/home',
    '/dashboard',
    '/repositorio',
    '/inventario',
    '/perfil'
];

// Obtener índice de ruta
function getRouteIndex(path) {
    const index = routeOrder.findIndex(route => path.includes(route));
    return index !== -1 ? index : 0;
}

// Determinar si es móvil
function isMobile() {
    return window.innerWidth <= 768;
}

// Inicializar transiciones
document.addEventListener('DOMContentLoaded', function() {
    // Almacenar ruta anterior
    let previousRoute = window.location.pathname;
    
    // Interceptar clicks en links de navegación
    const navLinks = document.querySelectorAll('a[href^="/"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Si es la misma página, no hacer nada
            if (href === window.location.pathname) {
                e.preventDefault();
                return;
            }
            
            // Si no es una navegación interna, dejar comportamiento normal
            if (this.getAttribute('target') === '_blank' || 
                href.startsWith('http') || 
                href.startsWith('#')) {
                return;
            }
            
            e.preventDefault();
            
            // Ejecutar transición
            performPageTransition(href, previousRoute);
            
            previousRoute = href;
        });
    });
    
    // Navbar dropdown toggle
    const userAvatar = document.querySelector('.navbar-avatar');
    const dropdown = document.querySelector('.navbar-dropdown');
    
    if (userAvatar && dropdown) {
        userAvatar.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });
        
        // Cerrar al hacer click fuera
        document.addEventListener('click', function() {
            dropdown.classList.remove('active');
        });
    }
    
    // Toggle menú hamburguesa
    const navToggle = document.querySelector('.navbar-toggle');
    const navMenu = document.querySelector('.navbar-menu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        // Cerrar al hacer click en un link
        const mobileLinks = navMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
    
    // Añadir animación inicial a las cards
    const cards = document.querySelectorAll('.glass-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        setTimeout(() => {
            card.classList.add('card-animate');
            card.style.opacity = '1';
        }, index * 100);
    });
});

// Realizar transición de página
function performPageTransition(newUrl, oldUrl) {
    const mainContent = document.querySelector('main') || document.body;
    
    // Determinar dirección del slide
    const oldIndex = getRouteIndex(oldUrl);
    const newIndex = getRouteIndex(newUrl);
    const isForward = newIndex > oldIndex;
    
    // Mostrar loading overlay
    showLoading();
    
    // En móvil usar fade, en desktop usar slide
    const mobile = isMobile();
    const exitClass = mobile ? 'fadeOut' : (isForward ? 'slideOutLeft' : 'slideOutRight');
    const enterClass = mobile ? 'fadeIn' : (isForward ? 'slideInRight' : 'slideInLeft');
    
    // Aplicar animación de salida
    mainContent.style.animation = `${exitClass} 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards`;
    
    // Esperar animación y navegar
    setTimeout(() => {
        window.location.href = newUrl;
    }, 400);
}

// Mostrar loading spinner
function showLoading() {
    let overlay = document.getElementById('loadingOverlay');
    
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'loadingOverlay';
        overlay.className = 'loading-overlay';
        overlay.innerHTML = `
            <div class="glass-spinner-orbital">
                <div class="spinner-dot"></div>
            </div>
            <div class="loading-text">Cargando...</div>
        `;
        document.body.appendChild(overlay);
    }
    
    setTimeout(() => {
        overlay.classList.add('active');
    }, 10);
}

// Ocultar loading spinner
function hideLoading() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
        overlay.classList.remove('active');
        setTimeout(() => {
            overlay.remove();
        }, 300);
    }
}

// Añadir efecto ripple a botones
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('ripple') || 
        e.target.closest('.ripple')) {
        const button = e.target.classList.contains('ripple') ? 
            e.target : e.target.closest('.ripple');
        
        const rect = button.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            width: 100%;
            height: 100%;
            top: ${y}px;
            left: ${x}px;
            transform: translate(-50%, -50%) scale(0);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: rippleEffect 0.6s ease-out;
        `;
        
        button.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }
});

// Crear animación ripple en CSS si no existe
if (!document.getElementById('rippleAnimation')) {
    const style = document.createElement('style');
    style.id = 'rippleAnimation';
    style.textContent = `
        @keyframes rippleEffect {
            to {
                transform: translate(-50%, -50%) scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Sistema de modales
window.openModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
};

window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
};

// Cerrar modal al hacer click en overlay
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('glass-modal-overlay')) {
        e.target.classList.remove('active');
        document.body.style.overflow = '';
    }
});

// Sistema de tooltips
function initTooltips() {
    const elements = document.querySelectorAll('[data-tooltip]');
    
    elements.forEach(element => {
        const tooltip = document.createElement('div');
        tooltip.className = 'glass-tooltip';
        tooltip.textContent = element.getAttribute('data-tooltip');
        document.body.appendChild(tooltip);
        
        element.addEventListener('mouseenter', function(e) {
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + rect.width / 2 + 'px';
            tooltip.style.top = rect.top + 'px';
            tooltip.style.transform = 'translateX(-50%) translateY(-100%)';
            tooltip.classList.add('show');
        });
        
        element.addEventListener('mouseleave', function() {
            tooltip.classList.remove('show');
        });
    });
}

// Inicializar tooltips cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTooltips);
} else {
    initTooltips();
}