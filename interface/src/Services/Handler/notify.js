import { Notify, QSpinnerGears } from 'quasar'

export default {
  csutomMessage(message, color, textColor, icon, spinner = QSpinnerGears, timeout, position, classes = 'glossy') {

  },
  successMessage(message, color = 'positive', icon = 'check_circle') {
    Notify.create({
      message,
      color,
      icon,
      textColor: 'white',
      classes: 'glossy',
      progress: true,
      position: 'top-right',
      actions: [
        { label: 'x', color: 'white', handler: () => { /* ... */ } },
      ]
    })
  },
  errorMessage(message, color = 'negative', icon = 'error') {
    Notify.create({
      message,
      color,
      icon,
      textColor: 'white',
      classes: 'glossy',
      progress: true,
      position: 'top-right',
      actions: [
        { label: 'x', color: 'white', handler: () => { /* ... */ } },
      ]
    })
  }
}
