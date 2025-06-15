<template>
  <div class="sidebar">
    <h2 class="sidebar-title">Category</h2>

    <ul class="menu-list">
      <li v-for="item in menuItems" :key="item.id" class="menu-item">
        <a :href="item.link" class="menu-link">
          <span class="label">{{ item.label }}</span>
        </a>
      </li>
    </ul>
  </div>
</template>

<script setup>

  import { useStore } from '../Store/store.js';

  const store = useStore(); 
  const menuItems = store.categories;
  
</script>

<style scoped>

.sidebar-title {
    display: flex;
    justify-content: center;
    font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 1rem;
  color: white;
  text-transform: uppercase;
}

.label {
    cursor: pointer;
}

.sidebar {
  width: 100%;
  background-color: #2c3e50;
  color: white;
  height: 100vh;
  padding: 1rem;
  box-sizing: border-box;
  transition: width 0.3s ease;
  display: flex;
  flex-direction: column;
}


.toggle-btn {
  background: none;
  border: none;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  margin-bottom: 1rem;
  align-self: flex-end;
}

.menu-list {
  list-style: none;
  padding: 0;
  margin: 0;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.menu-item {
  margin: 1rem 0;
}

.menu-link {
  display: flex;
  align-items: center;
  color: white;
  text-decoration: none;
  font-weight: 500;
  font-size: 1rem;
}

.menu-link:hover {
   text-decoration: underline;
}

.icon {
  margin-right: 1rem;
  font-size: 1.2rem;
}
</style>