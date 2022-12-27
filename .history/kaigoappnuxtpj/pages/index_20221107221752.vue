<template>
  <div class="container">
    <h1>{{ title }}</h1>
    <p>{{ description }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: 'Nuxt.js',
      description: 'let`s learn Nuxt.js',
    }
  },
}
</script>

<style>
.container {
  padding: 30px;
}
</style>