<template>
  <div class="container">
    <h1>{{ title }}</h1>
    <p>{{ description }}</p>
    <NuxtLogo></NuxtLogo>
    <NuxtLink :to="{path: 'users/test'}">usersへ</NuxtLink>
    <NuxtLink to="/other">otherへ</NuxtLink>
  </div>
</template>

<script>
import NuxtLogo from '../components/NuxtLogo.vue'
export default {
  components: {
    NuxtLogo,
  }
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