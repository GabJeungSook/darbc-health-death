import './bootstrap'
import autoAnimate from '@formkit/auto-animate'
import Alpine from 'alpinejs'
import Focus from '@alpinejs/focus'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'

Alpine.plugin(Focus)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
window.Alpine = Alpine
Alpine.directive('animate', (el) => {
  autoAnimate(el)
})
Alpine.start()
