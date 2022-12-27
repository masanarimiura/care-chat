<template>
<div class="container">
<FooBar message="メッセージ"></FooBar> //message属性
</div>
</template>

<script>
import NuxtLogo from '../components/NuxtLogo.vue'
export default {
  data() {
    return {
      title: 'Nuxt.js',
      description: 'let`s learning Nuxt.js',
    }
  },
}
</script>

<style>
.container {
  padding: 30px;
}
</style>