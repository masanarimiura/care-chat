<template>
<div class="container">
<button @click="goErrorPage">エラーが発生するボタン</button>
</div>
</template>

<script>
export default {
methods: {
goErrorPage() {
this.$nuxt.error({
statusCode: 404,
});
},
},
};
</script>