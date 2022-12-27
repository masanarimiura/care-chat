<template>
  <div class="container">
    <h1>{{ title }}</h1>
    <p>{{ description }}</p>
    <NuxtLink :to="{path: 'users/test'}">usersへ</NuxtLink>
  </div>
</template>

<script>
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