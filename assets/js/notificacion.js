// Función para mostrar la notificación
function mostrarNotificacion(mensaje, tipoNotificacion) {
    var notificacion = document.getElementById('notification');
    var elementoMensaje = document.getElementById('notification-message');
    elementoMensaje.textContent = mensaje;
    
    // Determinar la clase basada en el tipo de notificación
    switch(tipoNotificacion) {
        case 'éxito':
            notificacion.className = 'notification-container notify success';
            break;
        case 'advertencia':
            notificacion.className = 'notification-container notify warning';
            break;
        case 'peligro':
            notificacion.className = 'notification-container notify danger';
            break;
         case 'error':
            notificacion.className = 'notification-container notify error';
            break;
        default:
            notificacion.className = 'notification-container notify'; // Clase por defecto si el tipo no se reconoce
    }
     // Asegurarse de que las notificaciones no se solapen ajustando su posición basada en las notificaciones existentes
     var existingNotifications = document.querySelectorAll('.notification-container').length;
     console.log(existingNotifications);
     notificacion.style.bottom = (20 + (existingNotifications * 60)) + 'px'; // Ajustar la posición basada en la cantidad de notificaciones
    // Mostrar la notificación
    notificacion.style.display = 'block';
    
    // Ocultar la notificación después de 5 segundos
    setTimeout(function() {
        $(notificacion).fadeOut();
    }, 5000);
}