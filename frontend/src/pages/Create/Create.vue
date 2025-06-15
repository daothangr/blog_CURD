<template>
  <div class="wrapper">
    <div class="form-container">
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input v-model="title" type="text" class="form-control" id="title"  placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" v-model="category" class="form-select" aria-label="Default select example">
                <option disabled value=""> Category </option>
                <option v-for="category in menuCategory" :key="category.id" :value="category.label">{{ category.label }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label  for="content" class="form-label">Content</label>
                <textarea v-model="content" class="form-control" id="content" rows="3"></textarea>
            </div>
            <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" @change="handleFileChange" class="form-control" id="image" accept="image/*" />
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
  </div>
</template>

<script setup>
    import { ref } from 'vue'
    import axios from 'axios'
    import { useStore } from '../../Store/store.js';

    const store = useStore(); 
    const menuCategory = store.categories;

    const title = ref('')
    const category = ref('')
    const content = ref('')
    const image = ref(null)

    const handleFileChange = (event) => {
        image.value = event.target.files[0]
    }

    const submitForm = async () => {
        try {
            const formData = new FormData()
            formData.append('title', title.value)
            formData.append('category', category.value)
            formData.append('content', content.value)
            formData.append('image', image.value)

            console.log("FormData gửi đi:", formData)

            await axios.post('http://localhost:8000/api/blogs', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            alert('Gửi thành công!')
            title.value = ''
            category.value = ''
            content.value = ''
            image.value = null
        } catch (error) {
            alert('Lỗi gửi!')
            console.error(error)
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
