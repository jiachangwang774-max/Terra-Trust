<script setup>
import { ref} from 'vue'
const emits = defineEmits(['search'])
const keyword = ref('')

// 点击按钮
const handleSearch = () => {
  emits('search', keyword.value)
}
</script>

<template>
  <div class="search">
    <input
      v-model="keyword"
      placeholder="请输入关键词"
      @keyup.enter="handleSearch"
    />
    <button>搜索</button>
  </div>
</template>
<style scoped>
.search{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
    gap: 20px;
}
.search input{
    width: 500px;
    height: 50px;
    border: 5px solid #ccc;
    border-radius: 25px;
    padding: 0 10px;
}

.search input:focus{
  outline: 2px solid pink;
}
.search button{
    width: 50px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}
</style>