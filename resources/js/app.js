import './bootstrap';

document.addEventListener('alpine:init', () => {
    Alpine.data('darkMode', () => ({
      darkMode: localStorage.getItem('darkMode') === 'true',
      toggle() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
        document.documentElement.classList.toggle('dark', this.darkMode);
      }
    }));
  });

  document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('darkMode') === 'true') {
      document.documentElement.classList.add('dark');
    }
  });

