<template>
<div class="container">
<button @click="goErrorPage">ボタン</button>
</div>
</template>

<script>
export default {
methods: {
goErrorPage() {
this.$nuxt.error({
statusCode: 404,
message: "メッセージ",
path: this.$route.fullPath,
});
},
},
};
</script>