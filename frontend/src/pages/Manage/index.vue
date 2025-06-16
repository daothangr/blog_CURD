<template>
<div class="container">
    <div class="header-actions">
    <h1 class="title">Manage</h1>
    <router-link to="/create">
        <button class="btn-add">
        <i class="fa-solid fa-plus"></i> Add
        </button>
    </router-link>
    </div>
    <ul class="list">
    <div v-if="loading">Đang tải dữ liệu...</div>
    <li v-for="blog in blogs" :key="blog.id" class="list-item">
        <div class="item-content">
        <h4 class="item-title">{{ blog.title }}</h4>
        <p class="item-description">Updated: {{ formatDate(blog.updated_at) }}</p>
        </div>
        <div class="action-buttons">
            <router-link :to="'/edit/' + blog.id">
                <button class="btn-edit">
                <i class="fa-solid fa-pen"></i> Sửa
                </button>
            </router-link>
        
        <button class="btn-delete" @click="deleteBlog(blog.id)">
            <i class="fa-solid fa-trash-can"></i> Xóa
        </button>

        </div>
    </li>
    </ul>
</div>
</template>


<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios'

    const blogs = ref([])
    const loading = ref(true)

    const formatDate = (dateString) => {
        const date = new Date(dateString)
        const day = String(date.getDate()).padStart(2, '0')
        const month = String(date.getMonth() + 1).padStart(2, '0') 
        const year = date.getFullYear()
        return `${day}/${month}/${year}`
    }


    onMounted(async () => {
        try {
            const res = await axios.get('http://localhost:8000/api/blogs')
            blogs.value = res.data
        } catch (err) {
            console.error('Error:', err)
        } finally {
            loading.value = false
        }
    })

    const deleteBlog = async (id) => {
    const confirmDelete = confirm("Bạn có muốn xóa?");
    if (!confirmDelete) return;

    try {
        const res = await axios.delete(`http://localhost:8000/api/blogs/${id}`);
        alert(res.data.message);

        blogs.value = blogs.value.filter(blog => blog.id !== id);
    } catch (err) {
        console.error("Error: ", err);
        alert("Lỗi xóa bài viết");
    }
    };

</script> 

<style scoped>

    .header-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    }

    .btn-add {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    }

    .btn-add:hover {
    background-color: #388e3c;
    }

    .container {
    max-width: 900px;
    margin: 2rem auto;
    font-family: 'Roboto', sans-serif;
    }

    .title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    color: #333;
    }

    .action-buttons {
    display: flex;
    gap: 0.5rem; 
    }

    .list {
    list-style: none;
    padding: 0;
    margin: 0;
    }


.list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    padding: 1rem;
    margin-bottom: 1rem;
    transition: box-shadow 0.3s ease;
    flex-wrap: wrap; 
    gap: 1rem;
}

    .item-content {
    flex: 1;
    margin-right: 1rem;
    min-width: 0; 
    }



    .item-title {
    font-weight: 600;
    margin: 0 0 0.3rem 0;
    color: #6200ee;
    display: -webkit-box;         
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
    }

    .item-description {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    }

    .btn-edit,
    .btn-delete {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    border: none;
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 0.95rem;
    }

    .btn-edit {
    background-color: #6200ee;
    color: white;
    }

    .btn-edit:hover {
    background-color: #0288d1; 
    }


    .btn-delete {
    background-color: #e42f22; 
    color: white;
    }

    .btn-delete:hover {
    background-color: #d32f2f; 
    }

    router-link,
    router-link:visited,
    router-link:active,
    router-link:hover,
    a,
    a:visited,
    a:active,
    a:hover {
    text-decoration: none;
    color: inherit;
    }
</style>