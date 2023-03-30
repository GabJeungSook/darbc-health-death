import './bootstrap'
import autoAnimate from '@formkit/auto-animate'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.directive('animate', (el) => {
  autoAnimate(el)
})
Alpine.start()
