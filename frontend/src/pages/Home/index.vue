
<template>
  <div class="album py-5 bg-body-tertiary">
    <h1 class="text-3xl font-bold mb-6 text-center">Blog</h1>

    <div class="container">
      <div v-if="loading" class="text-center mb-4">Đang tải dữ liệu...</div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <div class="col" v-for="blog in blogs" :key="blog.id">
          <div 
            class="card h-100 shadow-sm d-flex flex-column justify-content-between"
            @click="$router.push({ name: 'BlogDetail', params: { id: blog.id } })"
            style="cursor: pointer;"
          >
            <img
              :src="`http://localhost:8000/storage/${blog.image_url}`"
              alt="Blog Image"
              class="card-img-top"
              style="height: 200px; object-fit: cover;"
            />

            <div class="card-body d-flex flex-column" style="min-height: 180px;">
              <h5
                class="card-title mb-2"
                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                :title="blog.title"
              >
                {{ blog.title }}
              </h5>

              <p class="card-text text-muted mb-2">{{ blog.category }}</p>

              <div class="mt-auto d-flex justify-content-end">
                <small class="text-body-secondary">{{ formatDate(blog.datetime) }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const blogs = ref([])
const loading = ref(true)

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return new Date(dateString).toLocaleDateString('vi-VN', options)
}

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/blogs')
    blogs.value = res.data;
    console.log(blogs);
  } catch (err) {
    console.error('Error:', err)
  } finally {
    loading.value = false
  }
})
</script> 