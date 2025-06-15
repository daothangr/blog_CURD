<template>
  <div class="container py-5" v-if="blog">
    <h1>{{ blog.title }}</h1>
    <img :src="blog.image_url" alt="" class="img-fluid mb-3" />
    <p><strong>Thể loại:</strong> {{ blog.category }}</p>
    <p><strong>Ngày đăng:</strong> {{ formatDate(blog.datetime) }}</p>
    <p><strong>Nội dung:</strong> {{ blog.content }}</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      blog: null,
    }
  },
  created() {
    const id = this.$route.params.id
    axios.get(`http://localhost:8000/api/blogs/${id}`).then(res => {
      this.blog = res.data
    })
  },
  methods: {
    formatDate(datetime) {
      return new Date(datetime).toLocaleDateString()
    },
  },
}
</script>
