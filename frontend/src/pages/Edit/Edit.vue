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
          <input v-model="image_url" type="text" class="form-control" id="image" placeholder="Image url" required />
        </div>

        <input class="btn btn-primary" type="submit" value="Update">
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
const image_url = ref('')

const blogId = route.params.id


onMounted(async () => {
  try {
    const res = await axios.get(`http://localhost:8000/api/blogs/${blogId}`)
    const blog = res.data
    title.value = blog.title
    category.value = blog.category
    content.value = blog.content
    image_url.value = blog.image_url
    
  } catch (err) {
    alert('Không tìm thấy blog')
    router.push('/manage')
  }
})


const submitForm = async () => {
  try {
    await axios.put(`http://localhost:8000/api/update/${blogId}`, {
      title: title.value,
      category: category.value,
      content: content.value,
      image_url: image_url.value      
    })

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
