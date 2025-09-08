document.addEventListener('DOMContentLoaded', () => {
  const year = new Date().getFullYear() ;
  const field = document.getElementById('year') ;
  field.textContent = year ;
}) ;