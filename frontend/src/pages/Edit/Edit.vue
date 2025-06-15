<template>
  <div class="wrapper">
    <div class="form-container">
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input v-model="title" type="text" class="form-control" id="title" placeholder="Title" required>
        </div>

        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select id="category" v-model="category" class="form-select" required>
            <option disabled value="">Category</option>
            <option v-for="cat in menuCategory" :key="cat.id" :value="cat.label">{{ cat.label }}</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea v-model="content" class="form-control" id="content" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image </label>
          <input type="file" @change="handleFileChange" class="form-control" id="image" accept="image/*" />
        </div>

        <input class="btn btn-primary" type="submit" value="Cập nhật">
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import { useStore } from '../../Store/store.js'

const route = useRoute()
const router = useRouter()
const store = useStore()
const menuCategory = store.categories

const title = ref('')
const category = ref('')
const content = ref('')
const image = ref(null)

const blogId = route.params.id


onMounted(async () => {
  try {
    const res = await axios.get(`http://localhost:8000/api/blogs/${blogId}`)
    const blog = res.data
    title.value = blog.title
    category.value = blog.category
    content.value = blog.content
    
  } catch (err) {
    alert('Không tìm thấy blog')
    router.push('/manage')
  }
})

const handleFileChange = (event) => {
  image.value = event.target.files[0]
}

const submitForm = async () => {
  try {
    const formData = new FormData()
    formData.append('title', title.value)
    formData.append('category', category.value)
    formData.append('content', content.value)

    if (image.value) {
      formData.append('image', image.value)
    }

    await axios.post(
      `http://localhost:8000/api/blogs/${blogId}?_method=PUT`,
      formData,
      {
        headers: { 'Content-Type': 'multipart/form-data' }
      }
    )

    alert('Cập nhật thành công!')
    router.push('/manage')
  } catch (error) {
    console.error(error)
    alert('Cập nhật thất bại!')
  }
}
</script>

<style scoped>
.wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f8f9fa;
}

.form-container {
  width: 100%;
  max-width: 600px;
  padding: 2rem;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
}
</style>
