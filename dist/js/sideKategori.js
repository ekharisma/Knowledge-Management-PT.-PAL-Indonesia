const sideHome = document.getElementById('side-home');
const sideDashboard = document.getElementById('side-dashboard');
const sideBerkas = document.getElementById('side-berkas');
const sideUpload = document.getElementById('side-upload');
const sideProfile = document.getElementById('side-profile');
const sidePrivate = document.getElementById('side-private');
const sidePublic = document.getElementById('side-public');
const sideKategori= document.getElementById('side-kategori');

sideHome.classList.remove('side-menu--active');
sideDashboard.classList.remove('side-menu--active');
sideBerkas.classList.remove('side-menu--active');
sideUpload.classList.remove('side-menu--active');
sideProfile.classList.remove('side-menu--active');
sidePrivate.classList.remove('side-menu--active');
sidePublic.classList.remove('side-menu--active');
sideKategori.classList.add('side-menu--active');