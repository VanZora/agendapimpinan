document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
      const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)
  
      // Validate that all variables exist
      if (toggle && nav && bodypd && headerpd) {
        toggle.addEventListener('click', () => {
          // show navbar
          nav.classList.toggle('show')
          // change icon
          toggle.classList.toggle('bx-x')
          // add padding to body
          bodypd.classList.toggle('body-pd')
          // add padding to header
          headerpd.classList.toggle('body-pd')
        })
      }
    }
  
    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')
  
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link');
  
    // Memeriksa apakah ada status aktif yang disimpan dalam storage
    const activeLink = localStorage.getItem('active');
    if (activeLink) {
      // Menambahkan kelas 'active' pada link yang disimpan
      document.querySelector(activeLink).classList.add('active');
    }
  
    function colorLink() {
      linkColor.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
  
      // Menyimpan status aktif pada storage
      localStorage.setItem('activeLink', `#${this.id}`);
    }
  
    linkColor.forEach(l => l.addEventListener('click', colorLink));
  
  
    // Your code to run since DOM is loaded and ready
  });
  
  function submitForm() {
    document.getElementById("inputan").submit();
  }
  
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  
  $(document).ready(function () {
    $('#example').DataTable();
    
  });
  
  