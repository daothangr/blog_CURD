<template>
  <div>
    <nav class="navbar d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <div class="logo d-flex align-items-center">        
        <img src="../assets/vue.svg" alt="logo" style="height: 28px; margin-right: 8px;" />
        Blog
      </div>

      <!-- Nút menu mobile -->
      <button class="d-md-none btn text-white" @click="toggleMobileMenu">
        <i class="bi bi-list" style="font-size: 1.5rem;"></i>
      </button>

      <!-- Menu desktop -->
        <ul class="nav-links d-none d-md-flex align-items-center mx-auto">
            <li><router-link to="/" exact>Home</router-link></li>
            <li><router-link to="/favorite">Favorite</router-link></li>
            <li><router-link to="/manage">Manage</router-link></li>
        </ul>

      <!-- Avatar admin -->
      <div class="admin-avatar" @click="toggleDropdown">
        <img src="https://i.pravatar.cc/300" alt="Admin" class="avatar-img" />
        <div v-if="dropdownOpen" class="dropdown-menu">
          <a href="#" @click.prevent="logout">Đăng xuất</a>
        </div>
      </div>
    </nav>

    <!-- Menu mobile -->
    <div v-if="mobileMenuOpen" class="mobile-menu d-md-none">
        <ul class="nav-links d-none d-md-flex align-items-center mx-auto">
            <li><router-link to="/" exact>Home</router-link></li>
            <li><router-link to="/favorite">Favorite</router-link></li>
            <li><router-link to="/manage">Manage</router-link></li>
        </ul>
    </div>

  </div>
</template>


<script setup>
import { ref } from 'vue'

const dropdownOpen = ref(false)
const mobileMenuOpen = ref(false)

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}

const logout = () => {
  alert('Đăng xuất thành công!')
  dropdownOpen.value = false
}

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}

const closeMobileMenu = () => {
  mobileMenuOpen.value = false
}
</script>


<style scoped>
.navbar {
  top: 0;
  left: 0;
  right: 0;
  height: 60px;
  background-color: #151D20;
  color: rgb(255, 255, 255);
  padding: 0 1rem;
  z-index: 1000;
}

.logo {
  font-weight: bold;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  text-decoration: none;
}

.nav-links {
  list-style: none;
  gap: 3rem;
  margin: 0;
  padding: 0;
}

.nav-links li {
  margin: 0 0.5rem;
}

.nav-links a {
  color: rgb(255, 255, 255);
  text-decoration: none;
  font-weight: 500;
  position: relative;
  padding-bottom: 4px;
}

::v-deep(.router-link-exact-active) {
  border-bottom: 2px solid #ffc107; 
}

.nav-links a:hover {
  border-bottom: 2px solid #ccc;
}


.admin-avatar {
  position: relative;
  cursor: pointer;
}

.avatar-img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 2px solid #fff;
}

.dropdown-menu {
  position: absolute;
  top: 42px;
  right: 0;
  background-color: white;
  color: black;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 0.5rem;
  min-width: 120px;
  z-index: 1001;
}

.dropdown-menu a {
  color: black;
  text-decoration: none;
  display: block;
}

.dropdown-menu a:hover {
  background-color: #f0f0f0;
}

/* Menu mobile */
.mobile-menu {
  background-color: #151D20;
  padding: 1rem;
}

.mobile-menu ul {
  list-style: none;
  padding-left: 0;
}

.mobile-menu li {
  margin-bottom: 1rem;
}

.mobile-menu a {
  color: white;
  text-decoration: none;
  font-size: 1.1rem;
}

/* Nội dung */
.content {
  padding-top: 56px;
}

.section {
  height: 100vh;
  padding: 2rem;
  background-color: #f8f9fa;
}

.section.alternate {
  background-color: #e9ecef;
}




</style>

